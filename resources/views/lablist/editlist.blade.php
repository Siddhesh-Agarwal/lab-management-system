public function edits($id)
{
    $totalDeviceCount = Labmove_table::count();
    $totalTempCount = Temp::count();
    $labs = Lab_Table::get();
    $data = Lab::where('id', '=', $id)->first();
    return view('lab.editlistadmin', ['data' => $data, 'totalDeviceCount' => $totalDeviceCount, 'totalTempCount' => $totalTempCount, 'labs' => $labs]);
}