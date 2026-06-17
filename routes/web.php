<?php

use App\Models\Student;
use App\Models\Teacher;
use App\Models\ExamGrade;
use App\Http\Controllers\ExamController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ModuleController;
use App\Http\Controllers\SectorController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\SessionController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\SubjectController;

use App\Http\Controllers\TeacherController;
use App\Http\Controllers\ExamGradeController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\AdminManagementController;
use App\Http\Controllers\StudentManagementController;
use App\Http\Controllers\TeacherManagementController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

//----------------------------------------Home Page---------------------------------------------------------------------

Route::controller(HomeController::class)->group(function ()
{
    Route::get('/', 'index')->name('home');
    Route::post('/contact', 'store')->name('home.store');
});


//Authentification
Route::controller(SessionController::class)->group(function ()
{
    Route::get('/login', 'create')->name('login')->middleware('guest');
    Route::post('/login', 'store')->name('login.store')->middleware('guest');
    Route::get('/logout', 'logout')->name('logout');
});

//--------------------------------------------Admin---------------------------------------------------------------------


Route::prefix('admin')->middleware('auth:admin')->group(function ()
{

    Route::controller(AdminManagementController::class)->group(function ()
    {
        //General
        Route::get('/', 'index')->name('admin.dashboard');
        Route::get('/students', 'students')->name('students');
        Route::get('/profile', 'profile')->name('profile');
        Route::get('/department', 'departments')->name('department');

        // Sector
        Route::prefix('sector')->group(function ()
        {
            Route::get('sectors', 'sector')->name('sector');
            Route::get('edit/{id}', 'editSector')->name('sector.edit');
            Route::put('update/{id}', 'updateSector')->name('sector.update');
            Route::delete('delete/{id}', 'deleteSector')->name('sector.delete');
            Route::get('add', 'addSector')->name('sector.add');
            Route::post('store', 'storeSector')->name('sector.store');
            Route::get('{id}/modules', 'showModules')->name('modules');
            Route::get('semester/{id}/addModule', 'addModule')->name('semester.addModule');
            Route::post('semester/{id}/storeModule', 'storeModule')->name('store_module');
            Route::delete('semester/module/{id}/delete', 'deleteModule')->name('delete_module');
            Route::get('semester/module/{id}/edit', 'editModule')->name('module.edit');
            Route::put('semester/module/{id}/update', 'updateModule')->name('module.update');
        });
    });


    //Students
    Route::prefix('students')->group(function ()
    {
        Route::controller(StudentController::class)->group(function ()
        {
            Route::get('create', 'create')->name('students.create');
            Route::get('importCSV', 'importCSV')->name('students.importCSV');
            Route::post('import', 'import')->name('students.import');
            Route::post('store', 'store')->name('students.store');
            Route::get('search', 'search')->name('students.search');
            Route::get('{id}', 'show')->name('students.show');
            Route::get('{id}/edit', 'edit')->name('students.edit');
            Route::put('{id}', 'update')->name('students.update');
            Route::get('{id}/editSector', 'editSector')->name('students.editSector');
            Route::get('{id}/absences', 'getAbsences')->name('students.absences');
            Route::get('{id}/semesterGrades', 'getSemesterGrades')->name('students.semesterGrades');
        });
    });

    //Students
    Route::prefix('messages')->group(function ()
    {
        Route::controller(MessageController::class)->group(function ()
        {
            Route::delete('{id}/delete', 'destroy')->name('messages.destroy');
            Route::post('{id}/marquer-lu', 'marquerCommeLu')->name('marquerLu');
            Route::delete('delete-all', 'deleteAll')->name('message.deleteAll');
            Route::get('non-lus', 'getUnreadMessages')->name('messages.unread');
            Route::delete('lus', 'deleteReadMessages')->name('messages.delete-read');
        });
    });

    //Profile
    Route::post('/profile/{id}/update', [AdminController::class, 'update'])->name('profile.update');

    //Departement
    Route::prefix('department')->group(function ()
    {
        Route::controller(DepartmentController::class)->group(function ()
        {
            Route::get('create', 'create')->name('department.create');
            Route::post('store', 'store')->name('department.store');
            Route::get('{id}/edit', 'edit')->name('department.edit');
            Route::post('{id}/update', 'update')->name('department.update');
            Route::get('{id}/delete', 'delete')->name('department.delete');
            Route::get('deleteAll', 'deleteAll')->name('department.deleteAll');
            Route::get('GetDelete', 'GetDeletePage')->name('department.GetDelete');
        });
    });
    Route::controller(TeacherController::class)->group(function ()
    {
        Route::get('/teachers', 'index')->name('teachers');
        Route::post('/teachers', 'store')->name('teachers.store');
        Route::get('/teachers/{id}/edit', 'edit')->name('teachers.edit');
        Route::delete('/teachers/{id}', 'destroy')->name('teachers.destroy');
        Route::put('/teachers/{id}', 'update')->name('teachers.update');

        Route::get('/admin/teachers/index', 'index')->name('teachers.index');
        Route::get('/admin/teachers/{id}/edit', 'edit')->name('teachers.edit');
        Route::put('/admin/teachers/{id}', 'update')->name('teachers.update');
    });
});

//----------------------------------------Teacher-----------------------------------------------------------------------

Route::prefix('teacher')->middleware('auth:teacher')->group(function ()
{
    Route::controller(TeacherManagementController::class)->group(function ()
    {
        Route::get('/', 'index')->name('teacher.dashboard');

        //Profile
        Route::get('/profile', 'profile')->name('teacher.profile');

        //Chef de Filiere
        Route::get('/ChefFil', 'ChefFilIndex')->name('ChefFil');
        Route::post('/assign-teacher/{subject}', 'assignTeacherToSubject')->name('assign-teacher');

        //Horaire
        Route::get('/HourlyLoadsManagement', 'teachers')->name('hourlyloads');

        //Chef de department
        Route::get('/chefDepartement', 'getChefDepIndex')->name('teacher.chefDep');

        //Absences
        Route::get('/absences', 'getAbsences')->name('teacher.absences');
        Route::get('/LesNotes', 'AffNotes')->name('thenotes');
    });

    //Charge Horaire
    Route::get('/HourlyLoadsManagement/hourly-loads', [TeacherController::class, 'showTeacherLoads'])->name('teachers.hourlyLoads');
    Route::get('/HourlyLoadsManagement/hourly-loads/search', [TeacherController::class, 'search'])->name('teachers.search');
    Route::post('/HourlyLoadsManagement/hourlyloads/store', [TeacherController::class, 'storeHourlyLoad'])->name('hourlyloads.store');

    //absences
    Route::get('/absences/search', [TeacherController::class, 'searchStudents'])->name('absences.search');
    Route::post('/absences/mark', [TeacherController::class, 'markAttendance'])->name('absences.mark');
    Route::post('/cancel-absence', [TeacherController::class, 'cancelAbsence'])->name('cancel.absence');


    Route::get('/LesNotes/saerch',[TeacherController::class,'ListStudents'])->name('Listsearch');
    Route::post('/saveNotes',[ExamGradeController::class,'saveNotes'])->name('saveLesNotes');









    //Chéf de departement
    Route::prefix('chefDep')->middleware('auth:teacher')->group(function ()
    {
        Route::controller(TeacherController::class)->group(function ()
        {
            Route::post('store', 'storeA')->name('teacherDep.store');
            Route::get('{id}/edit', 'editA')->name('teacherDep.edit');
            Route::post('update', 'updateAbde')->name('teacherDep.update');
            Route::get('{id}/delete', 'deleteA')->name('teacherDep.delete');
            Route::get('GetDelete', 'GetDeletePageA')->name('teacherDep.GetDelete');
        });
        //Notes

    });
    //fatiii
    Route::controller(SubjectController::class)->group(function ()
    {
        Route::get('/Document', 'subjects')->name('Document');
        Route::get('/Document/subjects', 'showTeacherSubjects')->name('teacher.subjects');
        Route::get('/Documents/{id}', 'show')->name('Documents');
        Route::post('/Documents/upload', 'upload')->name('documents.upload');

        // Route pour afficher le formulaire de modification
        Route::get('/documents/{id}/EditDocuments', 'edit')->name('documents.edit');

        // Route pour mettre à jour le cours
        Route::put('/documents/{id}', 'update')->name('documents.update');

        // Route pour supprimer le cours
        Route::delete('/documents/{id}', 'destroy')->name('documents.destroy');

        Route::get('/Document/TdetTp/{id}', 'showTdTp')->name('td_tp');
        Route::post('/Document/TdetTp/td_tp/upload', 'uploadTd')->name('documents.uploadTd');
        Route::post('/td_tp/upload', 'uploadTp')->name('documents.uploadTp');
        Route::get('/addTdTp/{id}', 'pageAdd')->name('addTdTp');



        // Route pour afficher le formulaire de modification pour TD
        Route::get('/teacher/Document/td_tp/td/{td}/edit', 'editTd')->name('documents.editTd');
        Route::delete('/teacher/Document/td_tp/td/{td}', 'destroyTd')->name('documents.destroyTd');
        Route::put('/teacher/Document/td_tp/EditTd/td/{td}', 'updateTd')->name('documents.updateTd');

        // Routes pour les TP
        Route::get('/teacher/Document/td_tp/tp/{tp}/edit', 'editTp')->name('documents.editTp');
        Route::delete('/teacher/Document/td_tp/tp/{tp}', 'destroyTp')->name('documents.destroyTp');
        Route::put('/teacher/Document/td_tp/tp/{tp}', 'updateTp')->name('documents.updateTp');

        // Routes pour les examens
        Route::get('/teacher/Document/exams/ExamsStudent/{id}', 'ExamsStudent')->name('exams.ExamsStudent');
        Route::post('/teacher/Document/exams/storeExams/{id}', 'storeExams')->name('exams.storeExams');
        Route::delete('/teacher/Document/exams/{exam}', 'destroyExam')->name('exams.destroyExam');
    });


    //Profile update
    Route::post('/{idTeacher}/updateA', [TeacherController::class, 'updateA'])->name('teachers.profile.update');
});


//----------------------------------------Student-----------------------------------------------------------------------


//Étudiant Routes
Route::prefix('student')->middleware('auth:student')->group(function ()
{
    Route::controller(StudentManagementController::class)->group(function ()
    {

        Route::get('/', 'index')->name('student.dashboard');
        Route::get('/cours', 'coursIndex')->name('cours');
        Route::get('/profile', 'profile')->name('student.profile');
        Route::get('/grades', 'grades')->name('grades');
        Route::get('/download/{file}', 'download')->name('download.file');

        Route::get('/dateExam', 'dateExamIndex')->name('dateExam');
    });

    Route::controller(StudentController::class)->group(function ()
    {
        Route::get('{id}/absences', 'getAbsencesAbd')->name('student.absencesAbde');
    });

    //Profile update
    Route::post('/{id}/updateA', [StudentController::class, 'updateA'])->name('students.profile.update');


});
