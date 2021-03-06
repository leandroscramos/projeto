<?php

include_once $_SESSION["root"].'php/Util/Util.php';
include_once $_SESSION["root"].'php/DAO/DatabaseConnection.php';
include_once $_SESSION["root"].'php/Model/ModelDocType.php';

class DocTypeDAO
{
    public function readDocType(){

        try { $sql = ('SELECT * FROM public.tb_doc_type ORDER BY id');
            $instance = DatabaseConnection::getInstance();
            $conn = $instance->getConnection();
            $statement = $conn->prepare($sql);
            $statement->execute();

            $records = $statement->fetchAll();
            //Verifico se houve algum retorno, senão retorno null
            if(count($records)==0)
                return null;
            //Var que irá armazenar um array de obj de tipos de documentos
            $doctypes;
            //Util::debug($linhas);
            foreach ($records as $value) {
                $doctype = new ModelDocType();
                $doctype->setDocTypeFromDatabase($value);
                $doctypes[]=$doctype;
            }
            return $doctypes;

        } catch (PDOException $e) {
            echo "Erro ao ler registros na base de dados.".$e->getMessage();
        }
    }

    public function createDocType($doctype){			
        
		try { $sql = ('INSERT INTO public.tb_doc_type (name, initials, level, max_rev_period) VALUES (:name, :initials, :level, :max_rev_period)');
            
            $instance = DatabaseConnection::getInstance();
            $conn = $instance->getConnection();			
            $statement = $conn->prepare($sql);
            
            $statement->bindValue(":name", $doctype->getName());
            $statement->bindValue(":initials", $doctype->getInitials());
            $statement->bindValue(":level", $doctype->getLevel());
            $statement->bindValue(":max_rev_period", $doctype->getRev());

            return $statement->execute();

        } catch (PDOException $e) {
            echo "Erro ao inserir na base de dados.".$e->getMessage();            
        }		
    }

    public function updateDocType($doctype) {
        
        try { $sql = ('UPDATE public.tb_doc_type SET level = :level, max_rev_period = :max_rev_period WHERE id = :id');

            $instance = DatabaseConnection::getInstance();
            $conn = $instance->getConnection();
            $statement = $conn->prepare($sql);

            $statement->bindParam(':id', $doctype->getId()); 
            //$statement->bindParam(':name', $doctype->getName()); 
            //$statement->bindParam(':initials', $doctype->getInitials()); 
            $statement->bindParam(':level', $doctype->getLevel()); 
            $statement->bindParam(':max_rev_period', $doctype->getRev()); 
            $statement->execute();
               
            return $statement->execute(); 
        } catch(PDOException $e) {
            echo "Erro ao atualizar registro da base de dados.".$e->getMessage();
        }
    }
    
    public function deleteDocType($id) {        

        try { $sql = ('DELETE FROM public.tb_doc_type WHERE id = :id');

            $instance = DatabaseConnection::getInstance();
            $conn = $instance->getConnection();
            $statement = $conn->prepare($sql);

            $statement->bindParam(':id', $id); 
            $statement->execute();
               
            return $statement->execute(); 
        } catch(PDOException $e) {
            echo "Erro ao excluir registro da base de dados.".$e->getMessage();
        }        
    }

    public function readDocTypeById($id){

        try { $sql = ('SELECT * FROM public.tb_doc_type WHERE id = :id');
            $instance = DatabaseConnection::getInstance();
            $conn = $instance->getConnection();
            $statement = $conn->prepare($sql);
                        
            $statement->bindParam(':id', $id); 
            $statement->execute();

            $records = $statement->fetchAll();
            
            if(count($records)==0)
                return null;

            $doctypes;
            
            foreach ($records as $value) {
                $doctype = new ModelDocType();
                $doctype->setDocTypeFromDatabase($value);
                $doctypes[]=$doctype;
            }
            return $doctypes;

        } catch (PDOException $e) {
            return $e->getMessage();
        }
    }  

    public function readDocTypeByName($name){

        try { $sql = ('SELECT * FROM public.tb_doc_type WHERE name = :name');
            $instance = DatabaseConnection::getInstance();
            $conn = $instance->getConnection();
            $statement = $conn->prepare($sql);
                        
            $statement->bindParam(':name', $name); 
            $statement->execute();

            $records = $statement->fetchAll();
            
            if(count($records)==0)
                return null;

            $doctypes;
            
            foreach ($records as $value) {
                $doctype = new ModelDocType();
                $doctype->setDocTypeFromDatabase($value);
                $doctypes[]=$doctype;
            }
            return $doctypes;

        } catch (PDOException $e) {
            return $e->getMessage();
        }
    }    
}