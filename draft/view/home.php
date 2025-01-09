<?php


namespace Ziel\View;

#set html content variable
#set data variable for javascript if needed
#

class Home {

    public static function home_init()
    {
        global $aPage;
        $aPage = array();
        $aPage['content'] = $aPage['projekt'] = '';
        $aPage['title'] = 'Home';
        /*
        $aPage['title'] = '🔆 Dashboard';
        #✅❎❤️‍🩹🔱🔆
        $aPage['projekt'] = <<<END
        <br/>🩹Projekt: Terminplaner
        <br/>
        <br/>🕐 Start: 24.10.2022
        <br/>🕤 Ende: 28.10.2022
        <br/>
        <br/>📢 Erstellen Sie eine Internetseite mit einem Terminplaner.
        <br/>
        <br/>💲 Das Projekt soll folgende Features enthalten:
        <br/>
        <br/>🔱 Die Daten werden in einer Datenbank gespeichert
        <br/>🔱 Ein externer Bereich (ohne Loginschutz)
        <br/>🔱 Ein interner Bereich (über Login geschützt)	
        <br/>🔱 Termine in einer Übersicht darstellen
        <br/>🔱 Termine einzeln in einer Detailansicht darstellen
        <br/>🔱 Neue Termine erstellen
        <br/>🔱 Termine suchen	
        <br/>🔱 Termine bearbeiten
        <br/>🔱 Termine löschen
        <br/>
        <br/>🩹 Hilfsmittel:
        <br/>❤️‍Kursunterlagen, Bücher, Internetrecherche, Onlinedokumentationen
        <br/>
        <br/>
        <br/>
        <br/>
        <br/>
        <br/>
        <br/>
        <br/>
        <br/>🎨 Bewertung in Punkte:
        <br/>#################################################################################
        <br/>❎ 15 P 	1. Datenbank: Erstellen Sie eine Termindatenbank 
        <br/>		
        <br/>❎ 5 P 	2. Navigation: Erstellen Sie eine dynamische Navigation 
        <br/>		über mehrere Unterseiten 
        <br/>		
        <br/>❎ 10 P	3. Daten anzeigen: Erstellen Sie einen öffentlichen Bereich 
        <br/>		mit einer Anzeige.			
        <br/>		
        <br/>❎ 10 p	4. Login: Erstellen Sie einen Loginformular zum einloggen 
        <br/>		für einen internen Bereich (inkl. Logout).
        <br/>		
        <br/>❎ 10 P	5. Daten bearbeiten: Erstellen Sie einen internen Bereich 
        <br/>		mit einer Anzeige der Verwaltungsübersicht inkl. Sortierung der Daten.	
        <br/>		
        <br/>❎ 15 P	6. Daten einfügen: Erstellen Sie ein Formular zum Erstellen 
        <br/>		von neuen Terminen und speichern Sie den Termin in der Datenbank.		
        <br/>		
        <br/>❎ 15 P	7. Daten ändern: Erstellen Sie ein Formular zum Ändern von Terminen 
        <br/>		und speichern Sie die Änderungen in der Datenbank.	
        <br/>		
        <br/>❎ 15 P	8. Daten löschen: Erstellen Sie ein Formular / Link zum löschen 
        <br/>		und löschen Sie die Daten in der Datenbank 
        <br/>		
        <br/>❎ 5  P	9. Daten suchen: Erstellen Sie eine Suchmöglichkeit / 
        <br/>		Filterung nach Termine
        <br/>		
        <br/>✅ 100 P	INSGESAMT
        <br/>
        <br/>
        <br/>
        END;
        */
        /*
        10 P	3. Daten anzeigen: Erstellen Sie einen รถffentlichen Bereich 
        		mit einer Anzeige.		
        */
        $aPage['content'] .= '
        	<div id="sidebar">
        	</div>
        	<div id="content">
        		<h3>🔆 Home</h3>
        		<hr></br>
        		'. $aPage['projekt'] .'
        	</div>
        ';
        
        #print '<pre>';
        #var_dump([
            #'home_init()',
            #$aPage
        #]);
        #print '</pre>';
        
        
        #print '<pre>';
        #var_dump([
        #    'home_init()',
        #    $aPage
        #]);
        #print '</pre>';
        return true;
    }

}

?>