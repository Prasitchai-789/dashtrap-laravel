<?php

namespace App\Livewire\HRE;

use Carbon\Carbon;
use Livewire\Component;
use App\Models\HRE\Employee;
use App\Models\WIN\EmpTitle;
use App\Models\WIN\Religion;
use Livewire\WithPagination;
use App\Models\WIN\Education;
use App\Models\WIN\WebappDept;
use App\Models\Location\WebCity;
use App\Models\Location\Province;

class EmployeeLive extends Component
{
    use WithPagination;
    protected $paginationTheme = 'tailwind';
    protected $listeners = ['deleteConfirmed' => 'deleteItem'];
    public $edit = false;
    public $showModal = false;
    public Employee $employee;
    public $deleteId;
    public $updateId;
    public $ProvinceID;
    public
        $EmpID,
        $viewEmployee_id = "",
        $IDCardNumber,
        $EmpCode,
        $EmpTitle,
        $sex,
        $EmpName,
        $Position,
        $DeptID,
        $DeptName,
        $BeginWorkDate,
        $BirthDay,
        $EduID,
        $EduName,
        $ReligionID,
        $ReligionName,
        $Address,
        $SubDistID,
        $SubDistName,
        $DistID,
        $DistrictID = "",
        $DistName,
        $ProvinceName,
        $ZipCode,
        $Image,
        $Status = "",
        $Email,
        $Title,
        $age,
        $Yearofservice,
        $CodeDistricts,
        $CodeSubDistricts,
        $FilterEmp,
        $Company,
        $FilterCompany,
        $FilterStatus,
        $Tel;
    public $provinceID;
    public $districtID;


    public bool $isLoading = false;

    public function initLoading()
    {
        $this->isLoading = true;
    }
    public function openModal()
    {
        $this->showModal = true;
    }
    public function addEmployee()
    {
        $this->edit = false;
    }

    protected $rules = [
        // 'EmpID' => 'required',
        // 'IDCardNumber' => 'required',
        // 'EmpCode' => 'required',
        // 'EmpTitle' => 'required',
        // 'EmpName' => 'required',
        // 'Position' => 'required',
        // 'DeptID' => 'required',
        // 'BeginWorkDate' => 'required',
        // 'BirthDay' => 'required',
        // 'EduID' => 'required',
        // 'ReligionID' => 'required',
        // 'Address' => 'required',
        // 'SubDistID' => 'required',
        // 'DistID' => 'required',
        // 'ProvinceID' => 'required',
        // 'ZipCode' => 'required',
        // // 'Image' => 'required',
        // 'Status' => 'required',
        // 'Email' => 'required',
        // 'Tel' => 'required',
        // 'Company' => 'required',
    ];
    public function updated()
    {
        $ProvinceID = $this->ProvinceID;
        if ($ProvinceID) {
            $Districts = WebCity::where('ProvinceID', $this->ProvinceID)
                ->select('DistrictID', 'DistrictName')
                ->groupBy('DistrictID', 'DistrictName')
                ->get();
        }
        $DistrictID = $this->DistID;
        if ($DistrictID) {
            $SubDistricts = WebCity::where('DistrictID', $this->DistID)
                ->select('SubDistrictID', 'SubDistrictName')
                ->groupBy('SubDistrictID', 'SubDistrictName')
                ->get();
        }
        $Status = $this->Status;
    }

    public function getProvinces()
    {
        $Province = Province::where('ProvinceID', $this->ProvinceID)->first();
        $ProvinceID = $Province->ProvinceID;
    }

    public function getDistricts()
    {
        //
    }


    public function render()
    {
        Carbon::setLocale('th');
        // try {
        $ProvinceID = $this->ProvinceID;
        $query = Employee::query();
        if ($this->FilterCompany == "ISP") {
            $query->where("Company", "ISP")
                ->where(function ($q) {
                    $q->whereNull('Status')
                        ->orWhere('Status', "1");
                });
        } else if ($this->FilterCompany == "MUN") {
            $query->where("Company", "MUN")->where(function ($q) {
                $q->whereNull('Status')
                    ->orWhere('Status', "1");
            });
        }

        if ($this->FilterEmp == "") {
            $query->whereIn("EmpTitle", ["1000", "1001", "1002"]);
        } else if ($this->FilterEmp != "1000") {
            $query->whereIn("EmpTitle", ["1001", "1002"]);
        } else {
            $query->where("EmpTitle", "1000");
        }

        if ($this->FilterStatus == "5") {
            $query->where(function ($q) {
                $q->whereNull('Status')
                    ->orWhere('Status', "");
            });
        }

        $employees = $query->orderBy('EmpID', 'ASC')->paginate(10);

        $depts = WebappDept::orderBy('DeptID', 'ASC')->get();
        $EmpTitles = EmpTitle::orderBy('EmpTitleID', 'ASC')->get();
        $Educations = Education::orderBy('EduID', 'ASC')->get();
        $Religions = Religion::orderBy('ReligionID', 'ASC')->get();

        $Cities = WebCity::where('ProvinceID', $ProvinceID)
            ->distinct('DistrictName')
            ->get();
        $Provinces = Province::orderBy('ProvinceID', 'ASC')->get();

        $Districts = WebCity::where('ProvinceID', $this->ProvinceID)
            ->select('DistrictID', 'DistrictName')
            ->groupBy('DistrictID', 'DistrictName')
            ->get();
        $subDists = WebCity::where('ProvinceID', $this->ProvinceID)
            ->where('DistrictID', $this->DistID)
            ->distinct('DistrictName')
            ->get();

        // นับจำนวนพนักงานแยกตามเพศ
        $MaleCount = $query->where("EmpTitle", "1000")->count();
        $OutEmps = $query->where(function ($q) {
            $q->whereNull('Status')
                ->orWhere('Status', "");
        })->count();

        $TotalEmps = $employees->total();
        $FemaleCount = $TotalEmps - $MaleCount;
        return view('livewire.hre.employee-live', [
            'employees' => $employees,
            'depts' => $depts,
            'EmpTitles' => $EmpTitles,
            'Educations' => $Educations,
            'Religions' => $Religions,
            'Cities' => $Cities,
            'Provinces' => $Provinces,
            'Districts' => $Districts,
            'SubDistricts' => $subDists,
            'MaleCount' => ($MaleCount == 0 ? "-" : number_format($MaleCount, 0)),
            'FemaleCount' => ($FemaleCount == 0 ? "-" : number_format($FemaleCount, 0)),
            'TotalEmps' => ($TotalEmps == 0 ? "-" : number_format($TotalEmps, 0)),

        ]);
    }
    public function closeModal()
    {
        $this->resetInputFields();
        $this->showModal = false;
    }
    public function resetInputFields()
    {
        $this->EmpID = '';
        $this->IDCardNumber = '';
        $this->EmpCode = '';
        $this->EmpTitle = '';
        $this->sex = '';
        $this->EmpName = '';
        $this->Position = null;
        $this->DeptID = '';
        $this->DeptName = '';
        $this->BeginWorkDate = '';
        $this->BirthDay = '';
        $this->EduID = '';
        $this->ReligionID = '';
        $this->Address = '';
        $this->ProvinceID = '';
        $this->DistID = '';
        $this->SubDistID = '';
        $this->ZipCode = '';
        $this->Email = '';
        $this->Tel = '';
    }
    public function saveEmployee()
    {
        // try {
        $validatedData = $this->validate(
            [
                'EmpCode' => 'required',
                'EmpTitle' => 'required',
                'EmpName' => 'required',
                'IDCardNumber' => 'required|digits:13',
                'BirthDay' => 'required',
                'EduID' => 'required',
                'ReligionID' => 'required',
                'Company' => 'required',
                'Position' => 'required',
                'DeptID' => 'required',
                'BeginWorkDate' => 'required',
                'Address' => 'required',
                'ProvinceID' => 'required',
                'DistID' => 'required',
                'SubDistID' => 'required',
                'ZipCode' => 'required',
                'Email' => 'nullable',
                'Tel' => 'nullable',
                // 'Image' => 'image|max:1024',
                // 'Status' => 'nullable',
            ]
        );

        $lastEmpID = Employee::max('EmpID');
        $validatedData['EmpID'] = $lastEmpID ? $lastEmpID + 1 : 1001; // ถ้ายังไม่มีข้อมูลเริ่มที่ 1001
        // dd($validatedData);
        // if ($this->Image) {
        //     $filePath = $this->Image->storeAs('Image_upload', $this->Image->getClientOriginalName(), 'public');
        //     $validatedData['Image'] = $filePath;
        // }
        Employee::create($validatedData);
        $this->dispatch(
            'alert',
            position: "center",
            icon: "success",
            title: "บันทึกข้อมูลสำเร็จ",
            showConfirmButton: false,
            timer: 1500
        );

        $this->closeModal();
        // } catch (\Throwable $th) {
        //     $this->dispatch(
        //         'alert',
        //         position: "center",
        //         icon: "error",
        //         title: "เกิดข้อผิดพลาด",
        //         showConfirmButton: false,
        //         timer: 1600
        //     );
        // }
    }


    public function confirmEdit($id)
    {
        $this->showModal = true;
        $this->edit = true;
        $this->updateId = $id;
        $this->resetInputFields();
        $this->updated();
        $employee = Employee::find($id);
        $this->EmpCode = $employee->EmpCode;
        $this->EmpTitle = $employee->EmpTitle;
        $this->EmpName = $employee->EmpName;
        $this->IDCardNumber = $employee->IDCardNumber;
        if ($employee) {
            $this->BirthDay = date_format(date_create($employee->BirthDay), "Y-m-d");
        }
        $this->EduID = $employee->EduID;
        $this->ReligionID = $employee->ReligionID;
        $this->Position = $employee->Position;
        $this->DeptID = $employee->DeptID;
        if ($employee) {
            $this->BeginWorkDate = date_format(date_create($employee->BeginWorkDate), "Y-m-d");
        }
        $this->Address = $employee->Address;

        if ($employee) {
            $this->ProvinceID = $employee->ProvinceID;

            if ($employee->DistID) {
                $this->DistID = $employee->DistID;
            }

            if ($employee->SubDistID) {
                $this->SubDistID = $employee->SubDistID;
            }
        }

        $this->ZipCode = $employee->ZipCode;
        $this->Status = $employee->Status;
        $this->Email = $employee->Email;
        $this->Tel = $employee->Tel;
        $this->Image = $employee->Image;
    }
    public function updateEmployee()
    {
        $validatedData = $this->validate(
            [
                'EmpCode' => 'required',
                'EmpTitle' => 'required',
                'EmpName' => 'required',
                'IDCardNumber' => 'required|digits:13',
                'BirthDay' => 'required',
                'EduID' => 'required',
                'ReligionID' => 'required',
                'Company' => 'required',
                'Position' => 'required',
                'DeptID' => 'required',
                'BeginWorkDate' => 'required',
                'Address' => 'required',
                'ProvinceID' => 'required',
                'DistID' => 'required',
                'SubDistID' => 'required',
                'ZipCode' => 'required',
                'Email' => 'nullable',
                'Tel' => 'nullable',
                // 'Image' => 'image|max:1024',
                // 'Status' => 'nullable',
            ]
        );
        $employee = Employee::findOrFail($this->updateId);
        $validatedData['EmpID'] = $employee->EmpID;
        $employee->update($validatedData);
        $this->dispatch(
            'alert',
            position: "center",
            icon: "success",
            title: "บันทึกข้อมูลสำเร็จ",
            showConfirmButton: false,
            timer: 1500
        );

        $this->closeModal();
    }

    public function confirmDelete($id)
    {
        $this->deleteId = $id;
        $employee = Employee::find($id);
        $this->dispatch(
            'alertConfirmDelete',
            [
                'deleteId' => $this->deleteId,
            ]
        );
        if ($employee) {
            $this->dispatch(
                'alertConfirmDelete',
                [
                    'deleteId' => $this->deleteId,
                ]
            );
        } else {
            // จัดการกรณีที่ไม่พบผู้ใช้
            session()->flash('error', 'User not found.');
        }
    }

    public function deleteItem()
    {
        $employee = Employee::find($this->deleteId);
        if ($employee) {
            $employee->delete();
            $this->dispatch(
                'alert',
                position: "center",
                icon: "success",
                title: "ลบข้อมูลสำเร็จ",
                showConfirmButton: false,
                timer: 1600
            );
        } else {
            session()->flash('error', 'Computer not found.');
        }
    }
}
