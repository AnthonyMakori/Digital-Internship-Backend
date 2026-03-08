<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{Department, Category, University, Faculty, EvaluationCriterion, SystemConfig};

class AdminSettingsController extends Controller {

    // Departments
    public function getDepartments() { return response()->json(Department::all()); }
    public function addDepartment(Request $req) {
        $d = Department::create(['name' => $req->name]);
        return response()->json($d);
    }
    public function removeDepartment($id) { Department::findOrFail($id)->delete(); return response()->noContent(); }

    // Categories
    public function getCategories() { return response()->json(Category::all()); }
    public function addCategory(Request $req) {
        $c = Category::create(['name' => $req->name]);
        return response()->json($c);
    }
    public function removeCategory($id) { Category::findOrFail($id)->delete(); return response()->noContent(); }

    // Universities & Faculties
    public function getUniversities() {
        return response()->json(University::with('faculties')->get());
    }
    public function addUniversity(Request $req) {
        $u = University::create($req->only(['name','location']));
        return response()->json($u);
    }
    public function removeUniversity($id) {
        University::findOrFail($id)->delete();
        return response()->noContent();
    }

    public function addFaculty(Request $req) {
        $f = Faculty::create([
            'name' => $req->name,
            'university_id' => $req->university_id,
            'departments' => $req->departments
        ]);
        return response()->json($f);
    }
    public function removeFaculty($id) {
        Faculty::findOrFail($id)->delete();
        return response()->noContent();
    }

    // Evaluation Criteria
    public function getEvalCriteria() { return response()->json(EvaluationCriterion::all()); }
    public function addEvalCriterion(Request $req) {
        $c = EvaluationCriterion::create($req->only(['criterion','weight']));
        return response()->json($c);
    }
    public function updateEvalCriterion(Request $req, $id) {
        $c = EvaluationCriterion::findOrFail($id);
        $c->update(['weight' => $req->weight]);
        return response()->json($c);
    }
    public function removeEvalCriterion($id) { EvaluationCriterion::findOrFail($id)->delete(); return response()->noContent(); }

    // System Config
    public function getSystemConfig() {
        $config = SystemConfig::first();
        if(!$config) $config = SystemConfig::create([]);
        return response()->json($config);
    }
    public function updateSystemConfig(Request $req) {
        $config = SystemConfig::firstOrFail();
        $config->update($req->all());
        return response()->json($config);
    }
}
