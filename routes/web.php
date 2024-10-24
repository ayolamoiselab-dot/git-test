<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StockController;
use App\Http\Controllers\VentesController;
use App\Http\Controllers\TransportController;
use App\Http\Controllers\EleveController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\RequetesController;
use App\Http\Controllers\RequeteTransportController;
use App\Http\Controllers\RequeteInformatiqueController;
use App\Http\Controllers\RequetePiscineController;
use App\Http\Controllers\DecaissementsController;
use App\Http\Controllers\CafetariatController;
use App\Http\Controllers\CantineJournaliereController;
use App\Http\Controllers\RecuController;
use App\Http\Controllers\CantineJourController;
use App\Http\Controllers\CinetpayController;
use Illuminate\Support\Facades\Auth;

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

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', function () {
        return view('menusgestion.listmenus');
    })->name('dashboard');

    Route::get('/gestion', function () {
        return view('gestion');
    })->name('gestion');
});

Route::middleware(['auth', 'is_admin'])->group(function () {
    Route::get('/sign-in', [AdminController::class, 'showSignInForm'])->name('sign-in');
    Route::post('/sign-in', [AdminController::class, 'store'])->name('store-user');
});

Route::get('/', function () {
    return view('welcome');
});

Route::get('/logout', function () {
    Auth::logout();
    return redirect('/');
})->name('logoutpro');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

Route::get('/ventes', [VentesController::class, 'index'])->name('ventes.index');
Route::get('/ventes/jour', [VentesController::class, 'ventesDuJour'])->name('ventes.jour');
Route::get('/ventes/create', [VentesController::class, 'create'])->name('ventes.create');
Route::post('/ventes', [VentesController::class, 'store'])->name('ventes.store');
Route::get('/ventes/recu/{id}', [VentesController::class, 'generateReceipt'])->name('ventes.generateReceipt');

Route::get('/ajouter-stock', [StockController::class, 'showAddStockForm'])->name('showAddStockForm');
Route::post('/ajouter-stock', [StockController::class, 'addStock'])->name('addStock');
Route::get('/quantite-restante', [StockController::class, 'showRemainingQuantities'])->name('showRemainingQuantities');



Route::get('/receipt/generate/{id_eleve}/{type}', [EleveController::class, 'generateReceipt'])->name('receipt.generate');
Route::post('/enregistrer', [EleveController::class, 'enregistrer'])->name('enregistrer');
Route::put('/mise-a-jour/{id}', [EleveController::class, 'miseAJour'])->name('miseAJour');
Route::match(['get', 'post'],'/scolarite-recherche', [EleveController::class, 'recherche'])->name('scolarite.recherche');
Route::match(['get', 'post'],'/scolarite-miseajour/{id}', [EleveController::class, 'miseAJour'])->name('scolarite.miseajour');


Route::get('/acceuil', function () {
    return view('welcome');
});

Route::get('/menus', function () {
    return view('menusgestion.listmenus');
});

Route::get('/cantinejour', function () {
    return view('cantine.recherche');
});

Route::get('/requetes', [RequetesController::class, 'index'])->name('requetes.index'); // Correction ici

Route::get('/menucantine', function () {
    return view('menusgestion.cantine');
});

Route::get('/inscription', function () {
    return view('inscription.formulaire');
});

Route::get('/pagemiseajourcantine', function () {
    return view('menusgestion.miseajourcantine');
});
Route::get('/pagemiseajourinformatique', function () {
    return view('menusgestion.miseajourinformatique');
});
Route::get('/pagemiseajourpiscine', function () {
    return view('menusgestion.miseajourpiscine');
});
Route::get('/pagemiseajourtransport', function () {
    return view('menusgestion.miseajourtransport');
});
Route::get('/pagemiseajourmusique', function () {
    return view('menusgestion.miseajourmusique');
});


Route::post('/enregistrer-eleve', [EleveController::class, 'enregistrer'])->name('enregistrer_eleve');

Route::get('/successanimation/success', function () {
    return view('successanimation.success');
});




Route::get('/menus', [EleveController::class, 'afficherTableauDeBord']);
/*
Route::match(['get', 'post'], '/recherche-cantine', [EleveController::class, 'rechercheCantine'])->name('cantine.recherche'); // Correction ici
Route::match(['get', 'post'], '/enregistrer-cantine', [EleveController::class, 'enregistrerCantine'])->name('cantine.enregistrer');
Route::match(['get', 'post'], '/recherche-transport', [EleveController::class, 'rechercheTransport'])->name('transport.recherche');
Route::match(['get', 'post'], '/enregistrer-transport', [EleveController::class, 'enregistrerTransport'])->name('transport.enregistrer');
Route::match(['get', 'post'], '/recherche-informatique', [EleveController::class, 'rechercheInformatique'])->name('informatique.recherche');
Route::match(['get', 'post'], '/enregistrer-informatique', [EleveController::class, 'enregistrerInformatique'])->name('informatique.enregistrer');
Route::match(['get', 'post'], '/recherche-piscine', [EleveController::class, 'recherchePiscine'])->name('piscine.recherche');
Route::match(['get', 'post'], '/enregistrer-piscine', [EleveController::class, 'enregistrerPiscine'])->name('piscine.enregistrer');
Route::match(['get', 'post'], '/recherche-musique', [EleveController::class, 'rechercheMusique'])->name('musique.recherche');
Route::match(['get', 'post'], '/enregistrer-musique', [EleveController::class, 'enregistrerMusique'])->name('musique.enregistrer');
*/

//mise a jour
Route::any('/cantine/recherche', [EleveController::class, 'rechercheCantinemiseajour'])->name('cantine.recherche');
Route::any('/recherche-cantine-maj', [EleveController::class, 'rechercheCantinemiseajour']);
Route::any('/transport/recherche', [EleveController::class, 'rechercheTransportmiseajour'])->name('transport.recherche');
Route::any('/recherche-transport-maj', [EleveController::class, 'rechercheTransportmiseajour']);
Route::any('/informatique/recherche', [EleveController::class, 'rechercheInformatiquemiseajour'])->name('informatique.recherche');
Route::any('/recherche-informatique-maj', [EleveController::class, 'rechercheInformatiquemiseajour']);
Route::any('/musique/recherche', [EleveController::class, 'rechercheMusiquemiseajour'])->name('musique.recherche');
Route::any('/recherche-musique-maj', [EleveController::class, 'rechercheMusiquemiseajour']);

//Route::match(['get', 'post'], '/cantine/recherche', [EleveController::class, 'rechercheCantinemiseajour'])->name('cantine.recherche');

Route::match(['get', 'post'], '/cantine/miseAJour/{id}', [EleveController::class, 'miseAJourCantine'])->name('cantine.miseajour');
//Route::match(['get', 'post'], '/transport/recherche', [EleveController::class, 'rechercheTransportmiseajour'])->name('transport.recherche');
Route::match(['get', 'post'], '/transport/miseAJour/{id}', [EleveController::class, 'miseAJourTransport'])->name('transport.miseajour');
//Route::match(['get', 'post'], '/informatique/recherche', [EleveController::class, 'rechercheInformatiquemiseajour'])->name('informatique.recherche');
Route::match(['get', 'post'], '/informatique/miseAJour/{id}', [EleveController::class, 'miseAJourInformatique'])->name('informatique.miseajour');
Route::match(['get', 'post'], '/piscine/recherche', [EleveController::class, 'recherchePiscinemiseajour'])->name('piscine.recherche');
Route::match(['get', 'post'], '/piscine/miseAJour/{id}', [EleveController::class, 'miseAJourPiscine'])->name('piscine.miseajour');
//Route::match(['get', 'post'], '/musique/recherche', [EleveController::class, 'rechercheMusiquemiseajour'])->name('musique.recherche');
Route::match(['get', 'post'], '/musique/miseAJour/{id}', [EleveController::class, 'miseAJourMusique'])->name('musique.miseajour');

//sans mise a jour
Route::match(['get', 'post'], '/recherche-cantine', [EleveController::class, 'rechercheCantine'])->name('recherche.cantine'); // Correction ici
Route::match(['get', 'post'], '/enregistrer-cantine', [EleveController::class, 'enregistrerCantine'])->name('enregistrer.cantine');
Route::match(['get', 'post'], '/recherche-informatique', [EleveController::class, 'rechercheInformatique'])->name('recherche.informatique');
Route::match(['get', 'post'], '/enregistrer-informatique', [EleveController::class, 'enregistrerInformatique'])->name('enregistrer.informatique');
Route::match(['get', 'post'], '/recherche-transport', [EleveController::class, 'rechercheTransport'])->name('recherche.transport');
Route::match(['get', 'post'], '/enregistrer-transport', [EleveController::class, 'enregistrerTransport'])->name('enregistrer.transport');
Route::match(['get', 'post'], '/recherche-piscine', [EleveController::class, 'recherchePiscine'])->name('recherche.piscine');
Route::match(['get', 'post'], '/enregistrer-piscine', [EleveController::class, 'enregistrerPiscine'])->name('enregistrer.piscine');
Route::match(['get', 'post'], '/recherche-musique', [EleveController::class, 'rechercheMusique'])->name('recherche.musique');
Route::match(['get', 'post'], '/enregistrer-musique', [EleveController::class, 'enregistrerMusique'])->name('enregistrer.musique');

Route::get('/successanimation/success', function () {
    return view('successanimation.success');
});

Route::get('/menus', function () {
    return view('menusgestion.listmenus');
});



  

Route::match(['get', 'post'],'/scolarite-recherche', [EleveController::class, 'recherche'])->name('scolarite.recherche');
Route::match(['get', 'post'],'/scolarite-miseajour/{id}', [EleveController::class, 'miseAJour'])->name('scolarite.miseajour');

//Route::match(['get', 'post'], '/recherche-cantine', [EleveController::class, 'rechercheCantine'])->name('cantine.recherche');
//Route::match(['get', 'post'], '/enregistrer-cantine', [EleveController::class, 'enregistrerCantine'])->name('cantine.enregistrer');
Route::match(['get', 'post'], '/cantine/miseAJour/{id}', [EleveController::class, 'miseAJourCantine'])->name('cantine.miseajour');

Route::get('/menuinformatique', function () {
    return view('menusgestion.informatique');
});

Route::get('/menutransport', function () {
    return view('menusgestion.transport');
});

Route::get('/menumusique', function () {
    return view('menusgestion.musique');
});

Route::get('/menuscolarite', function () {
    return view('menusgestion.scolarite');
});

Route::get('/menupiscine', function () {
    return view('menusgestion.piscine');
});

Route::get('/ventes', [VentesController::class, 'index'])->name('ventes.index');
Route::get('/ventes/jour', [VentesController::class, 'ventesDuJour'])->name('ventes.jour');
Route::get('/ventes/create', [VentesController::class, 'create'])->name('ventes.create');
Route::post('/ventes', [VentesController::class, 'store'])->name('ventes.store');
Route::get('/ventes/recu/{id}', [VentesController::class, 'generateReceipt'])->name('ventes.generateReceipt');
Route::delete('/ventes/{id}', [VentesController::class, 'destroy'])->name('ventes.destroy');


Route::get('/ajouter-stock', [StockController::class, 'showAddStockForm'])->name('showAddStockForm');
Route::post('/ajouter-stock', [StockController::class, 'addStock'])->name('addStock');
Route::get('/quantite-restante', [StockController::class, 'showRemainingQuantities'])->name('showRemainingQuantities');


//CAFETARIAT
Route::get('/menucafetariat', [CafetariatController::class, 'showMenu']);
Route::get('/cafetariat/nouveau', [CafetariatController::class, 'showForm']);
Route::post('/cafetariat/enregistrer', [CafetariatController::class, 'store']);
Route::get('/cafetariat/success/{id}', [CafetariatController::class, 'showSuccess'])->name('cafetariat.success');
Route::get('/cafetariat/recette/{id}', [CafetariatController::class, 'generateReceipt']);
// routes/web.php
Route::get('/cafetariat/recettes-jour', [CafetariatController::class, 'recettesJour'])->name('cafetariat.recettesJour');
Route::get('/cafetariat/recettes-periodiques', [CafetariatController::class, 'showPeriodForm'])->name('cafetariat.recettes.periodiques.form');
Route::post('/cafetariat/recettes-periodiques', [CafetariatController::class, 'getPeriodRecettes'])->name('cafetariat.recettes.periodiques.result');
Route::get('/cafetariat/abonnesJour', [CafetariatController::class, 'abonnesJour'])->name('cafetariat.abonnesJour');

//DECAISSEMENTS
Route::get('/decaissements', [DecaissementsController::class, 'index'])->name('decaissements.index');
Route::get('/decaissements/nouveau', [DecaissementsController::class, 'create'])->name('decaissements.create');
Route::post('/decaissements', [DecaissementsController::class, 'store'])->name('decaissements.store');
Route::get('/decaissements/success/{id}', [DecaissementsController::class, 'success'])->name('decaissements.success');
Route::get('/decaissements/{id}', [DecaissementsController::class, 'show'])->name('decaissements.show');
Route::get('/decaissement/jour', [DecaissementsController::class, 'decaissementsDuJour'])->name('decaissements.jour');
//decaissement jour modifiée
// Afficher la page pour entrer la date des décaissements du jour
//Route::get('/decaissements/jour', [DecaissementsController::class, 'showByDateForm'])->name('decaissements.jour');

// Traiter la recherche des décaissements par date
Route::post('/decaissement/jour', [DecaissementsController::class, 'searchByDate'])->name('decaissements.jour.search');

// Supprimer un décaissement
Route::delete('/decaissement/{id}', [DecaissementsController::class, 'destroy'])->name('decaissements.destroy');

// web.php
Route::get('/decaissement/periodiques', [DecaissementsController::class, 'showPeriodForm'])->name('decaissement.periodiques');
Route::post('/decaissements/periodiques/resultats', [DecaissementsController::class, 'listPeriodDecaissements']);

// web.php
Route::get('/decaissement/rechercher', [DecaissementsController::class, 'showSearchForm']);
Route::post('/decaissements/rechercher/resultats', [DecaissementsController::class, 'searchDecaissements']);


//REQUETES
Route::get('/requetes', [RequetesController::class, 'index'])->name('requetes.index');
Route::get('/requetes/scolarite', [RequetesController::class, 'scolarite'])->name('requetes.scolarite');
Route::post('/requetes/scolarite/result', [RequetesController::class, 'scolariteResult'])->name('requetes.scolarite.result');
Route::match(['get', 'post'],'/requetes/favorise/add', [RequetesController::class, 'addFavorise'])->name('requetes.favorise.add');

Route::post('/requetes/favorise/confirm', [RequetesController::class, 'confirmFavorise'])->name('requetes.favorise.confirm');

Route::get('/requetes/cantine', [RequetesController::class, 'cantine'])->name('requetes.cantine');
Route::post('/requetes/cantineResult', [RequetesController::class, 'cantineResult'])->name('requetes.cantineResult');

Route::get('/select-type', [RequetesController::class, 'selectType'])->name('requetes.choix_type');
Route::match(['get', 'post'],'/favorise', [RequetesController::class, 'favorise'])->name('requetes.favorise');
Route::post('/add-favorise', [RequetesController::class, 'addFavorise'])->name('requetes.addFavorise');
Route::post('/select-favorise', [RequetesController::class, 'selectFavorise'])->name('requetes.selectFavorise');


Route::get('/requetes/journalieres', [RequetesController::class, 'journalieres'])->name('requetes.journalieres');
//Route::get('/requetes/journalieres/scolarite', [RequetesController::class, 'versementScolariteDuJour'])->name('requetes.journalieres.scolarite');
//Route::get('/requetes/journalieres/cantine', [RequetesController::class, 'versementCantineDuJour'])->name('requetes.journalieres.cantine');
Route::get('/requetes/journalieres/scolarite', [RequetesController::class, 'showDateFormScolarite'])->name('requetes.journalieres.scolarite');
Route::post('/requetes/journalieres/scolarite', [RequetesController::class, 'scolariteByDate'])->name('requetes.journalieres.scolarite.result');
Route::get('/requetes/journalieres/cantine', [RequetesController::class, 'showDateFormCantine'])->name('requetes.journalieres.cantine');
Route::post('/requetes/journalieres/cantine', [RequetesController::class, 'cantineByDate'])->name('requetes.journalieres.cantine.result');
Route::get('/requetes/journalieres/transport', [RequetesController::class, 'showDateFormTransport'])->name('requetes.journalieres.transport');
Route::post('/requetes/journalieres/transport', [RequetesController::class, 'transportByDate'])->name('requetes.journalieres.transport.result');


Route::get('/requetes/eleves_effectif', [RequetesController::class, 'selectClasse'])->name('requetes.eleves_effectif');
Route::post('/requetes/eleves_effectif', [RequetesController::class, 'effectifEleves'])->name('requetes.effectif_eleves');

Route::get('/requetes/cantine_effectif', [RequetesController::class, 'selectClasse'])->name('requetes.cantine_effectif');
Route::post('/requetes/cantine_effectif', [RequetesController::class, 'effectifCantine'])->name('requetes.effectif_cantine');

Route::get('/requetes/contact_parent', [RequetesController::class, 'showContactParentForm'])->name('requetes.contact_parent');
Route::post('/requetes/contact_parent', [RequetesController::class, 'getContactParent'])->name('requetes.get_contact_parent');

Route::get('/requetes/statistiques_fonds', [RequetesController::class, 'showStatistiquesForm'])->name('requetes.statistiques_fonds');
Route::post('/requetes/statistiques_fonds', [RequetesController::class, 'getStatistiquesFonds'])->name('requetes.get_statistiques_fonds');

Route::get('/requetes/transport', [RequeteTransportController::class, 'index'])->name('requetes.transport');
Route::post('/requetes/transport/impayes', [RequeteTransportController::class, 'getImpayes'])->name('requetes.transport_impayes');
Route::get('/requetes/transport_effectif', [RequeteTransportController::class, 'selectClasse'])->name('requetes.transport_effectif');
Route::post('/requetes/transport_effectif', [RequeteTransportController::class, 'effectifTransport'])->name('requetes.effectif_transport');

Route::get('/requetes/informatique', [RequeteInformatiqueController::class, 'index'])->name('requetes.informatique');
Route::post('/requetes/informatique/impayes', [RequeteInformatiqueController::class, 'getImpayes'])->name('requetes.informatique_impayes');
Route::get('/requetes/informatique_effectif', [RequeteInformatiqueController::class, 'selectClasse'])->name('requetes.informatique_effectif');
Route::post('/requetes/informatique_effectif', [RequeteInformatiqueController::class, 'effectifInformatique'])->name('requetes.effectif_informatique');

Route::get('/requetes/piscine', [RequetePiscineController::class, 'index'])->name('requetes.piscine');
Route::post('/requetes/piscine/impayes', [RequetePiscineController::class, 'getImpayes'])->name('requetes.piscine_impayes');
Route::get('/requetes/piscine_effectif', [RequetePiscineController::class, 'selectClasse'])->name('requetes.piscine_effectif');
Route::post('/requetes/piscine_effectif', [RequetePiscineController::class, 'effectifPiscine'])->name('requetes.piscine_informatique');


Route::get('/requetes/effectif-nouveaux-inscrits', [RequetesController::class, 'effectifNouveauxInscrits'])->name('requetes.effectif_nouveaux_inscrits');


// web.php

Route::get('/scolarite/success/{id_eleve}/{type}', [EleveController::class, 'successPage'])->name('scolarite.success');
Route::get('/cantine/success/{id_eleve}/{type}', [EleveController::class, 'successPage2'])->name('cantine.success');
Route::get('/transport/success/{id_eleve}/{type}', [EleveController::class, 'successPage3'])->name('transport.success');
Route::get('/informatique/success/{id_eleve}/{type}', [EleveController::class, 'successPageInfo'])->name('informatique.success');
Route::get('/piscine/success/{id_eleve}/{type}', [EleveController::class, 'successPagePiscine'])->name('piscine.success');
Route::get('/musique/success/{id_eleve}/{type}', [EleveController::class, 'successPageMusique'])->name('musique.success');


//cantine journaliere
Route::get('/cantine/recherche', [CantineJournaliereController::class, 'rechercherEleve'])->name('cantine.rechercher');
Route::get('/cantine/paiement/{id_eleve}', [CantineJournaliereController::class, 'afficherFormulairePaiement'])->name('cantine.paiement');
Route::post('/cantine/paiement/{id_eleve}', [CantineJournaliereController::class, 'enregistrerPaiement'])->name('cantine.enregistrer');
Route::get('/cantine/recu/{id_eleve}', [CantineJournaliereController::class, 'genererRecu'])->name('cantine.recu');


//nouveaux inscrits requetes
// Route pour afficher le formulaire de recherche
Route::get('/requetes/inscrits', [EleveController::class, 'afficherFormulaireInscritsPeriodiques'])->name('requetes.inscritsPeriodiques');

// Route pour traiter la requête et afficher les résultats
Route::get('/requetes/inscrits/resultat', [EleveController::class, 'rechercheInscrits'])->name('requetes.inscritsResultat');

//ventes jour mise a jour
Route::get('/ventes/jour', [VentesController::class, 'showDateForm'])->name('ventes.jour');
Route::get('/ventes/jour/resultats', [VentesController::class, 'ventesDuJour'])->name('ventes.jour.resultats');

//rechercher un reçu
// Route vers le formulaire de recherche de reçu
Route::get('/recherche-recu', [RecuController::class, 'rechercheRecu'])->name('recherche.recu');
Route::get('/recherche-recu-cant', [RecuController::class, 'rechercheRecuCant'])->name('recherche.recucant');
Route::get('/recherche-recu-trans', [RecuController::class, 'rechercheRecuTrans'])->name('recherche.recutrans');
Route::get('/recherche-recu-cantjour', [RecuController::class, 'rechercheRecuCantJour'])->name('recherche.recucantjour');

// Route pour le résultat de la recherche
Route::get('/recherche-recu/result', [RecuController::class, 'resultatRechercheRecu'])->name('recherche.recu.result');
Route::get('/recherche-recu/result/cant', [RecuController::class, 'resultatRechercheRecuCant'])->name('recherche.recu.result.cant');
Route::get('/recherche-recu/result/trans', [RecuController::class, 'resultatRechercheRecuTrans'])->name('recherche.recu.result.trans');
Route::get('/recherche-recu/result/cantjour', [RecuController::class, 'resultatRechercheRecuCantJour'])->name('recherche.recu.result.cantjour');

//cantine jour
// routes/web.php



Route::get('/cantine/jour', [CantineJourController::class, 'showForm'])->name('cantine_jour.form');
Route::post('/cantine/jour', [CantineJourController::class, 'store'])->name('cantine_jour.store');
Route::get('/cantine/jour/receipt/{id}', [CantineJourController::class, 'generateReceipt'])->name('cantine_jour.receipt');



Route::post('/cinetpay/payment', [CinetpayController::class, 'initiatePayment'])->name('cinetpay.payment');
Route::get('/cinetpay/success', [CinetpayController::class, 'paymentSuccess'])->name('cinetpay.success');
Route::get('/cinetpay/cancel', [CinetpayController::class, 'paymentCancel'])->name('cinetpay.cancel');
Route::post('/cinetpay/notify', [CinetpayController::class, 'paymentNotify'])->name('cinetpay.notify');

Route::get('/payement', function () {
    return view('cinetpay.payment');
});