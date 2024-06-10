<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Course;
use App\Models\Category;
use Illuminate\Support\Facades\Storage;

class CourseController extends Controller
{
 
    public function store(Request $request)
    {
        try {
            // Validation des données du formulaire
            $request->validate([
                'logo' => 'required|image',
                'titre' => 'required|string|min:3',
                'description' => 'required|string|min:3',
                'module' => 'required|string|min:3',
                'auteur' => 'required|string|min:3',
                'prix' => 'required|numeric|min:5000|max:15000',
                'date' => 'required|string|min:3',
                'fichier' => 'required|file',
                'categorie' => 'required|string|min:3',
            ], [
                'titre.min' => 'Le titre doit comporter au moins 3 caractères.',
                'description.min' => 'La description doit comporter au moins 3 caractères.',
                'module.min' => 'Le module doit comporter au moins 3 caractères.',
                'auteur.min' => 'L\'auteur doit comporter au moins 3 caractères.',
                'prix.min' => 'Le prix doit être au moins 5.000 FCFA.',
                'prix.max' => 'Le prix ne doit pas dépasser 15.000 FCFA.',
                'prix.numeric' => 'Le prix doit être un nombre.',
                'date.min' => 'La date doit comporter au moins 3 caractères.',
                'categorie.min' => 'La catégorie doit comporter au moins 3 caractères.',
                 
                'titre.required' => 'Le titre est obligatoire.',
                'logo.required' => 'Le logo de la formation est obligatoire.',
                'fichier.required' => 'Le fichier de la formation est obligatoire.',
                'description.required' => 'La description est obligatoire.',
                'module.required' => 'Le module est obligatoire.',
                'auteur.required' => 'L\'auteur est obligatoire.',
                'prix.required' => 'Le prix est obligatoire.',
                'categorie.required' => 'La catégorie est obligatoire.',
            ]);

            // Chercher la catégorie, la créer si elle n'existe pas
            $category = Category::firstOrCreate(['nom' => $request->input('categorie')]);

            // Enregistrement de l'image dans le système de fichiers
            $imagePath = $request->file('logo')->store('public/imgFormations');
            $imagePath = str_replace('public/', 'storage/', $imagePath);

            // Enregistrement du fichier dans le système de fichiers
            $fichierPath = $request->file('fichier')->store('public/fichiersFormations');
            $fichierPath = str_replace('public/', 'storage/', $fichierPath);

            // Création du cours avec les chemins d'accès à l'image et au fichier
            $course = new Course();
    $course->logo = $imagePath;
    $course->titre = $request->titre;
    $course->description = $request->description;
    $course->modules = $request->module;
    $course->auteur = $request->auteur;
    $course->prix = $request->prix;
    $course->date = $request->date;
    $course->categorie = $request->categorie;
    $course->fichier = $fichierPath;
    $course->save();
            $course->save();

            // Définir le message de succès
            session()->flash('success', 'Cours ajouté avec succès!');

            return redirect()->back();
        } catch (QueryException $e) {
            return redirect()->back()->with('error', 'Erreur lors de l\'enregistrement de la formation');
        }
    }

public function index()
    {
        $categories = Category::with('courses')->get();
        $courses = Course::all();

 // Regrouper les cours par catégorie
 
        return view('listFormation', compact('courses','categories'));
    }
    public function showFichier($id){
        $course= Course::findOrFail($id);
        return view('showFichier',compact('course'));
    }



 
    


    public function show($id)
    {
        $courses  = Course::findOrFail($id);
        $logo = str_replace('public/', 'storage/', $courses->logo);
        return view('coursesShow', compact('courses','logo'));
    }

    public function create()
    {
        return view('courses.create');
    }

    public function edit($id)
    {
        $course = Course::findOrFail($id);
        // Récupérer l'URL de l'image et du fichier
    
        return view('editFormation', compact('course'));
    }

    public function update(Request $request, $id)
    {
        $course = Course::findOrFail($id);
       

        if ($request->hasFile('fichier')) {
            Storage::delete(str_replace('storage/', 'public/', $course->fichier));
            $fichier = $request->file('fichier')->store('public/fichiersFormations');

          $course->update([ $course->fichier = str_replace('public/', 'storage/',$fichier), ]);
           

        }
    
        // Supprimer l'ancienne image s'il y en a une et enregistrer la nouvelle
        if ($request->hasFile('logo')) {
            Storage::delete(str_replace('storage/', 'public/', $course->logo));
            $image = $request->file('logo')->store('public/imgFormations');
            
            $course->update([$course->logo= str_replace('public/', 'storage/',$image) ]);



            


        }
    
         $course->update([
            
                $course->titre=$request->input('titre'),
                $course->description=$request->input('description'),
                $course->auteur=$request->input('auteur'),
                $course->date=$request->input('date'),
                $course->prix=$request->input('prix'),
                $course->categorie=$request->input('categorie'),
                $course->modules=$request->input('module'),
    
    
    
            ]);


        
      
        





        return redirect()->route('courses.index')->with('success', 'Course updated successfully');
    }

    public function destroy($id)
    {
        $course = Course::findOrFail($id);
        $logoPath = str_replace('storage/', 'public/', $course->logo); 
        Storage::delete($logoPath);

        // Supprimer le fichier associé au cours, si il existe
        $fichierPath = str_replace('storage/', 'public/', $course->fichier); 
            Storage::delete($fichierPath);
            $course->delete();

        return redirect()->route('courses.index')->with('success', 'Course deleted successfully');
    }
   
}
