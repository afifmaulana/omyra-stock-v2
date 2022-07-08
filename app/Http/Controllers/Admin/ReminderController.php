<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Product;
use App\Models\Reminder;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReminderController extends Controller
{
    public function index()
    {
        $reminders = Reminder::orderBy('id', 'DESC')->paginate('10');
        return view('ui.admin.reminder.index',[
            'reminders' => $reminders
        ]);
    }

    public function create()
    {
        $brands = Brand::orderBy('name', 'ASC')->get();
        $products = Product::orderBy('id', 'DESC')->get();
        return view('ui.admin.reminder.create', [
            'brands' => $brands,
            'products' => $products,
        ]);
    }

    public function store(Request $request)
    {
        // dd($request->all());
        $this->validate($request, [
            'product' => 'required',
            'material' => 'required',
            'date' => 'required',
            'total' => 'required',
        ]);

        $reminder = new Reminder();
        $reminder->user_id = Auth::user()->id;
        $reminder->product_id = $request->product;
        $reminder->material_id = $request->material;
        $reminder->date =  Carbon::createFromFormat('d-m-Y', $request->date)->format('Y-m-d');
        $reminder->total = $request->total;
        $reminder->save();

        return redirect()->route('admin.reminder.index')->with('success', 'Berhasil menambahkan data baru!');
    }

    public function edit($id)
    {
        $products = Product::orderBy('id', 'DESC')->get();
        $reminder = Reminder::where('id', $id)->first();
        return view('ui.admin.reminder.edit',[
            'products' => $products,
            'reminder' => $reminder,
        ]);
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'product_id' => 'required',
            'material_id' => 'required',
            'date' => 'required',
            'total' => 'required',
        ]);
        $reminder = Reminder::where('id', $id)->first();
        $params = $request->all();

        $reminder->update([
            'product_id' => $params['product_id'] ?? $reminder->product_id,
            'material_id' => $params['material_id'] ?? $reminder->material_id,
            'date' => $params['date'] ?? $reminder->date,
            'total' => $params['total'] ?? $reminder->total,
        ]);
        return redirect()->route('admin.reminder.index')->with('success', 'Berhasil mengubah Reminder!');
    }

    public function destroy($id)
    {
        $reminder = Reminder::where('id', $id)->first();
        // dd($material);
        $reminder->delete();
        return redirect()->route('admin.reminder.index')->with(['success' => 'Berhasil menghapus data.']);
    }
}
