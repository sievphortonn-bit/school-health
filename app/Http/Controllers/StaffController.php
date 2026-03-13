<?php

namespace App\Http\Controllers;

use App\Models\Staff;
use Illuminate\Http\Request;

class StaffController extends Controller
{
    public function index()
    {
        $staffs = Staff::latest()->paginate(10);
        return view('staff.index', compact('staffs'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'code' => 'required|unique:staff,code',
            'name' => 'required',
            'age'  => 'required|numeric',
            'sex'  => 'required|in:Male,Female',
            'role' => 'required',
        ], [
            'code.required' => 'សូមបញ្ចូលអត្តលេខ',
            'name.required' => 'សូមបញ្ចូលឈ្មោះ',
            'sex.required'  => 'សូមជ្រើសភេទ',
            'role.required' => 'សូមជ្រើសតួនាទី',
        ]);

        Staff::create($request->all());

        return back()->with('success','បានបន្ថែមបុគ្គលិកជោគជ័យ');
    }

    public function show(Staff $staff)
    {
        return response()->json($staff);
    }

    public function update(Request $request, Staff $staff)
    {
        $request->validate([
            'code' => 'required|unique:staff,code,' . $staff->id,
            'name' => 'required',
            'age'  => 'required|numeric',
            'sex'  => 'required|in:Male,Female',
            'role' => 'required',
        ], [
            'code.required' => 'សូមបញ្ចូលអត្តលេខ',
            'code.unique'   => 'អត្តលេខនេះបានប្រើរួចហើយ',
            'name.required' => 'សូមបញ្ចូលឈ្មោះ',
            'age.required'  => 'សូមបញ្ចូលអាយុ',
            ]);

        $staff->update($request->all());

        return back()->with('success','បានកែប្រែព័ត៌មានជោគជ័យ');
    }

    public function destroy(Staff $staff)
    {
        $staff->delete();
        return back()->with('success','បានលុបបុគ្គលិក');
    }

    public function search(Request $request)
    {
        $q = $request->q;

        return Staff::where('name','like',"%$q%")
            ->orWhere('code','like',"%$q%")
            ->limit(20)
            ->get();
    }

    public function getRoleKhAttribute()
    {
        return [
            'admin'       => 'អ្នកគ្រប់គ្រង',
            'nurse'       => 'គិលានុបដ្ឋាយិកា',
            'teacher'     => 'គ្រូ',
            'staff'       => 'បុគ្គលិក',
            'security'    => 'សន្តិសុខ',
            'hr'          => 'មន្ត្រីធនធានមនុស្ស',
            'office'      => 'បុគ្គលិកការិយាល័យ',
            'secretary'   => 'លេខាធិការ',
            'cleaner'     => 'អ្នកសម្អាត',
            'it_officer'  => 'អ្នកគ្រប់គ្រងប្រព័ន្ធកុំព្យូទ័រ',
            'gardener'    => 'អ្នកថែសួន',
            'other'       => 'ផ្សេងៗ',
        ][$this->role] ?? '-';
    }

}
