<?php

use App\Models\Notification;
use App\Models\Status;

// ALL HELPERS FUNCTION
function required_icon()
{
    return "<span class='text-danger'>*</span>";
}
function getStatusTrx($status) 
{
    switch ($status) {
        case 1:
            return "<span class='label label-light-warning label-pill label-inline'> Pending </span>";
            break;
        
        case 2:
            return "<span class='label label-light-danger label-pill label-inline'> Rejected </span>";
            break;

        case 3:
            return "<span class='label label-light-success label-pill label-inline'> Approved </span>";
            break;

        case 4:
            return "<span class='label label-light-info label-pill label-inline'> Paid </span>";
            break;

        case 5:
            return "<span class='label label-light-success label-pill label-inline'> Done </span>";
            break;
        
        case 6:
            return "<span class='label label-light-warning label-pill label-inline'> Review Production </span>";
            break;
        
        case 7:
            return "<span class='label label-light-success label-pill label-inline'> Review Material </span>";
            break;

        case 8: 
            return "<span class='label label-light-success label-pill label-inline'> Owner's review </span>";
            break;
        
        case 9:
            return "<span class='label label-light-success label-pill label-inline'> Material Approved </span>";
            break;

        default:
            return "<span class='label label-light-danger label-pill label-inline'> Unknow Status </span>";
            break;
    }
}

function getRoleId()
{
    return auth()->user()->role->id;
}

function cRupiah($number)
{
    return number_format($number,0, ',' , '.');
}
