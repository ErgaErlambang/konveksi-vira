<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Orders;
use App\Models\OrderDetail;
use App\Models\Status;
use App\Models\Payment;
use App\Models\Material;
use App\Models\MaterialUsed;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use DB;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Orders::forRole()->get();
        
        return view('backend.orders.index', compact('orders'));
    }

    public function detail($id)
    {
        $materials = Material::all();
        $order = Orders::with('details')->findOrFail($id);
        $payments = Payment::where('order_id', $order->id)->get();
        return view('backend.orders.detail', compact("order", "payments", "materials"));
    }

    public function create()
    {
        $materials = Material::where('type_id', 1)->get();
        return view('backend.orders.create', compact('materials'));
    }

    public function store(Request $request)
    {
        try {
            // Validate
            $request->validate([
                "brand" => "required",
                "name" => "required",
                "phone" => "required",
                "quantity" => "required",
                "quantity.*" => "required|numeric|min:12",
                "size" => "required",
                "size.*" => "required",
                "color" => "required",
                "color.*" => "required",
                "material" => "required",
                "other_materials" => Rule::requiredIf($request->material == 'others'),

            ]);
            DB::beginTransaction();
            // Init Material
            $material = $request->material;
            // Check material, if it doenst exist then create a new material
            if(!empty($request->other_materials)) {
                // Remove this if this doenst needed
                $existing = Material::where('name', 'like', '%'.$request->other_materials.'%')->first();
                if(empty($existing)) {
                    // If Existing is null or the material doenst found, then create a new Material
                    $add_material = new Material;
                    $add_material->name = $request->other_materials;
                    $add_material->save();
                    $material = $add_material->id;
                }else {
                    $material = $existing->id;
                }
            }

            if(auth()->user()->role_id !== 6) {
                // Always create users if using backdoor transaction
                $email = strtolower(Str::slug($request->name, '-')).'@app.com';
                $user = User::where('email', $email)->first();
                $status = 6;
                if($user == null) {
                    $user = new User;
                    // role 6 == users, simple ways
                    $user->role_id = 6;
                    $user->name = $request->name;
                    $user->email = strtolower(Str::slug($request->name, '-')).'@app.com';
                    $user->password = bcrypt('password');
                    $user->save();
                }
            }else {
                $user = auth()->user();
                $status = 1;
            }

            $transaction = new Orders;
            // 1 = Pending, more check file : helpers/general_helpers.php
            $transaction->status = $status;
            $transaction->user_id = $user->id;
            $transaction->material_id = $material;
            $transaction->brand_name = $request->brand;
            $transaction->pic_name = $request->name;
            $transaction->pic_phone = $request->phone;
            $transaction->only_services = !empty($request->only_services) ? true : false;
            $transaction->installment = !empty($request->is_installment) ? true : false;

            if($request->hasFile("design")) {
                $path = storage_path("uploads/design/");
                if(!is_dir($path)) {
                    mkdir($path,755,true);
                }
                $logo = $request->file('design');
                $newName = "logo_".date("YmdHis").".".$request->design->extension();
                $move = $logo->move($path, $newName);
                $transaction->design = $newName;
            }

            // INV-tanggal-rand
            $no_invoice = "INV-".date("Ymd")."-".rand(1000,9999);
            $transaction->no_invoice = $no_invoice;
            $transaction->save();

            foreach ($request->quantity as $key => $qty) {
                $detail = new OrderDetail;
                $detail->quantity = $qty;
                $detail->color = $request->color[$key];
                $detail->size = $request->size[$key];
                $detail->order_id = $transaction->id;
                $detail->save();
            }

            DB::commit();

            return redirect()->route('admin.order.index')->with('success', 'Order has successfuly created, please wait for approval from Admin.');
            
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->with('error', $e->getMessage())->withInput();
        }
    }

    public function edit($id)
    {
        $order = Orders::findOrFail($id);
        return view('backend.orders.edit', compact('order'));
    }

    public function update(Request $request, $id)
    {
        try {
            $request->validate([
                "brand" => "required",
                "name" => "required",
                "phone" => "required",
                "article" => "required",
                "quantity" => "required",
                "size" => "required",
                "color" => "required"
            ]);
            $transaction = Orders::find($id);

            $data = [
                "brand" => $request->brand,
                "name" => $request->name,
                "phone" => $request->phone,
                "article" => $request->article,
                "quantity" => $request->quantity,
                "size" => $request->size,
                "color" => $request->color,
                "others" => $request->others,
                "data" => []
            ];
            DB::beginTransaction();

            $transaction->status_id = 1;
            $transaction->data = $data;
            $transaction->note = null;

            if($request->hasFile("design")) {
                $path = storage_path("uploads/design/");
                if(!is_dir($path)) {
                    mkdir($path,755,true);
                }
                $logo = $request->file('design');
                $newName = "logo_".date("YmdHis").".".$request->design->extension();
                $move = $logo->move($path, $newName);
                $transaction->image = $newName;
            }

            $transaction->update();

            $notif = Notification::message("new update for Order $id, check it out!")->broadcastTo(auth()->user()->id);

            DB::commit();

            return redirect()->route('admin.order.index')->with('success', 'Order has successfuly updated, please wait for approval from Admin.');
        } catch (Exception $e) {
            DB::rollback();
            return redirect()->back()->with('error', $e->getMessage())->withInput();
        }
    }

    public function approval(Request $request, $id)
    {
        try {

            $order = Orders::findOrFail($id);
            
            $request->validate([
                "status" => "required",
                "price" => Rule::requiredIf($request->status == 8),
            ]);

            
            DB::beginTransaction();

            $order->status = $request->status;
            if($request->status == 8) {
                $order->price = $request->price;
            }
            $order->update();

            if($request->status == 7) {
                foreach ($request->materials as $key => $material) {
                    if($material == "others") {
                        $new_material = new Material;
                        $new_material->name = $request->other_materials[$key];
                        $new_material->save();
                    }else {
                        $new_material = Material::find($material);
                    }
                    $used = new MaterialUsed;
                    $used->order_id = $order->id;
                    $used->material_id = $new_material->id;
                    $used->used = $request->quantity[$key];
                    $used->save();
                }
            }
            
            DB::commit();

           return redirect()->route('admin.order.index')->with('success', 'Order status has been successfuly updated.');

        } catch (Exception $e) {
            DB::rollback();
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function order_taken($id)
    {
        try {
            DB::beginTransaction();
            $status = Status::find(4);
            $order = Orders::findOrFail($id);
            $order->status_id = 4;
            $order->update();
            
            $history = new HistoryStatus;
            $history->user_id = auth()->user()->id;
            $history->status_id = 4;
            $history->transaction_id = $order->id;
            $history->save();

            Notification::message($status->phase)->broadcastAll();
            DB::commit();

            return redirect()->route('admin.order.index')->with('success', 'Order status has been successfuly updated.');
        } catch (Exception $e) {
            DB::rollback();
            return redirect()->back()->with('error', $e->getMessage())->withInput();
        }
    }

    public function travel_document($id)
    {
        try {
            $order = Orders::findOrFail($id);
            if(!empty($order->travel_document)) {
                return response()->download(public_path('uploads/pdf/'.$order->travel_document));
            }
            return redirect()->route('admin.order.index')->with('error', 'The order doesn`t have a travel document yet');
        } catch (Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function invoice($invoice)
    {
        try {
            $transaction = Orders::where('no_invoice', $invoice)->first();
            if(empty($transaction)) {
                return redirect()->route('admin.order.index')->with('error', 'The order doesn`t have an invoice yet');
            }

            return view('backend.orders.invoice', compact('transaction'));
        } catch (Exception $e) {
            return redirect()->route('admin.order.index')->with('error', $e->getMessage());
        }
    }

    public function payment(Request $request, $id)
    {
        try {
            $request->validate([
                "bukti_pembayaran" => "required",
            ]);

            $transaction = Orders::findOrFail($id);
            if($request->hasFile("bukti_pembayaran")) {
                $path = storage_path("uploads/bukti/");
                if(!is_dir($path)) {
                    mkdir($path,755,true);
                }
                $logo = $request->file('bukti_pembayaran');
                $newName = "bukti_".date("YmdHis").".".$request->bukti_pembayaran->extension();
                $move = $logo->move($path, $newName);
                
                $payment = new Payment;
                $payment->order_id = $transaction->id;
                $payment->nominal = $request->nominal;
                $payment->bukti = $newName;
                $payment->save();
            }

            $transaction->status = 4;
            $transaction->save();
            return redirect()->route('admin.order.index')->with('success', 'Bukti pembayaran berhasil di unggah, order anda sedang kami proses!');
        } catch (\Exception $e) {
            return redirect()->route('admin.order.detail', $id)->with('error', $e->getMessage());
        }
    }

}
