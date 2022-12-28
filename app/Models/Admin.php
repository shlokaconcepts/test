<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Department;
use App\Models\Company;
use Carbon\Carbon;
use URL;

class Admin extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    // protected $fillable = ['name','username','phone ','email','password','image','sig','panel','employee_id','interviewer_type','type','status','company','department'];
    protected $hidden = ['password', 'remember_token'];


    public function get_allowed_menus()
    {
        $current_user_department = auth()->user()->department;
        $departments = Department::select('add_menu', 'edit_menu', 'delete_menu', 'view_menu', 'download_menu', 'submit_btn_menu')->find($current_user_department);
        $allowed_menus['add'] = explode(',', $departments->add_menu);
        $allowed_menus['edit'] = explode(',', $departments->edit_menu);
        $allowed_menus['delete'] = explode(',', $departments->delete_menu);
        $allowed_menus['view'] = explode(',', $departments->view_menu);
        $allowed_menus['download'] = explode(',', $departments->download_menu);
        $allowed_menus['submit_btn'] = explode(',', $departments->submit_btn_menu);
        $allowed_menus['all'] = array_merge(explode(',', $departments->add_menu), explode(',', $departments->edit_menu), explode(',', $departments->delete_menu), explode(',', $departments->view_menu), explode(',', $departments->download_menu), explode(',', $departments->submit_btn_menu));
        return $allowed_menus;
    }

    public function check_parent_menu_exists($check_array, $allowed_menus)
    {

        foreach ($check_array as $val) {

            if (in_array($val, $allowed_menus)) {
                return true;
            }
        }
        return false;
    }


    public function getImageAttribute($value)
    {
        $serverURL = URL::to('/');
        if ($value == null || $value == '') {
            return $serverURL . '/public/assets/images/avatars/user.png';
        }
        return getImage($value);
    }



    public function getCompany()
    {
        return $this->belongsTo(Company::class, 'company', 'id');
    }


    public function getPanelName()
    {
        return $this->belongsTo(InterviewerPanel::class, 'panel', 'id');
    }

    public function getCreatedAtAttribute($value)
    {
        return Carbon::parse($value)->format('d M,Y');
    }
}
