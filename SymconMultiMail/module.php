<?
    // Klassendefinition
    class SymconMultiMail extends IPSModule {
 
        // Der Konstruktor des Moduls
        // Überschreibt den Standard Kontruktor von IPS
        public function __construct($InstanceID) {
            // Diese Zeile nicht löschen
            parent::__construct($InstanceID);
 
            
        }
 
        // Überschreibt die interne IPS_Create($id) Funktion
        public function Create() {

            parent::Create();
 
        }
 
        // Überschreibt die intere IPS_ApplyChanges($id) Funktion
        public function ApplyChanges() {
           
            parent::ApplyChanges();

        }

        public function SendMail ($Betreff, $Text) {

            if (IPS_HasChildren($this->InstanceID)) {

                $children = IPS_GetObject($this->InstanceID);

                foreach ($children['ChildrenIDs'] as $child) {

                    $child = IPS_GetObject($child);

                    // Wenn Instanz
                    if ($child['ObjectType'] == 1) {

                        $ichild = IPS_GetInstance($child['ObjectID']);

                        // Wenn SMTP
                        if ($ichild['ModuleInfo']['ModuleName'] == "SMTP") {

                            SMTP_SendMail($ichild['InstanceID'], $Betreff, $Text);

                        }

                        // Wenn MultiMail
                        if ($ichild['ModuleInfo']['ModuleName'] == "SymconMultiMail") {

                            MultiMail_SendMail($ichild['InstanceID'], $Betreff, $Text);

                        }

                    }

                    // Wenn Link
                    if ($child['ObjectType'] == 6) {

                        $child = IPS_GetLink($child['ObjectID']);
                        $target = IPS_GetObject($child['TargetID']);

                        if ($target['ObjectType'] == 1) {

                            $target = IPS_GetInstance($target['ObjectID']);

                            if ($target['ModuleInfo']['ModuleName'] == "SMTP") {

                                SMTP_SendMail($target['InstanceID'], $Betreff, $Text);
    
                            }   
                            
                            if ($target['ModuleInfo']['ModuleName'] == "SymconMultiMail") {

                                MultiMail_SendMail($target['InstanceID'], $Betreff, $Text);
    
                            }   

                        }

                    }

                }

            }

        }

        public function SendMailAttachment ($Betreff, $Text, $Attachment) {

            if (IPS_HasChildren($this->InstanceID)) {

                $children = IPS_GetObject($this->InstanceID);

                foreach ($children['ChildrenIDs'] as $child) {

                    $child = IPS_GetObject($child);

                    // Wenn Instanz
                    if ($child['ObjectType'] == 1) {

                        $ichild = IPS_GetInstance($child['ObjectID']);

                        if ($ichild['ModuleInfo']['ModuleName'] == "SMTP") {

                            SMTP_SendMailAttachment($ichild['InstanceID'], $Betreff, $Text, $Attachment);

                        }

                        if ($ichild['ModuleInfo']['ModuleName'] == "SymconMultiMail") {

                            MultiMail_SendMailAttachment($ichild['InstanceID'], $Betreff, $Text, $Attachment);

                        }

                    }

                    // Wenn Link
                    if ($child['ObjectType'] == 6) {

                        $child = IPS_GetLink($child['ObjectID']);
                        $target = IPS_GetObject($child['TargetID']);

                        if ($target['ObjectType'] == 1) {

                            $target = IPS_GetInstance($target['ObjectID']);

                            // Wenn SMTP
                            if ($target['ModuleInfo']['ModuleName'] == "SMTP") {

                                SMTP_SendMailAttachment($target['InstanceID'], $Betreff, $Text, $Attachment);
    
                            }   
                            
                            // Wenn MultiMail
                            if ($target['ModuleInfo']['ModuleName'] == "SymconMultiMail") {

                                MultiMail_SendMailAttachment($target['InstanceID'], $Betreff, $Text, $Attachment);
    
                            }

                        }

                    }

                }

            }

        }

 
    }
?>