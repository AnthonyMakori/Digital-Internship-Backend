<?php

namespace App\Http\Controllers\Api;

use App\Models\Vacancy;
use Illuminate\Http\Request;

class VacancyController extends Controller
{
    public function index($companyId)
    {
        return Vacancy::where('company_id', $companyId)
            ->latest()
            ->get();
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string',
            'department' => 'required|string',
            'location' => 'required|string',
            'duration' => 'required|string',
            'description' => 'required|string',
            'requirements' => 'required|array',
            'company_id' => 'required|exists:companies,id'
        ]);

        $vacancy = Vacancy::create($validated);

        return response()->json($vacancy, 201);
    }

    public function update(Request $request, $id)
    {
        $vacancy = Vacancy::findOrFail($id);

        $vacancy->update($request->all());

        return response()->json($vacancy);
    }

    public function destroy($id)
    {
        Vacancy::findOrFail($id)->delete();

        return response()->json(['message' => 'Deleted successfully']);
    }

    public function toggleStatus($id)
    {
        $vacancy = Vacancy::findOrFail($id);

        $vacancy->status = $vacancy->status === 'open' ? 'closed' : 'open';
        $vacancy->save();

        return response()->json($vacancy);
    }
}
