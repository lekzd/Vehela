<?php

    Class Tools {


        public static function getIncludedFiles(){

            $included_files = get_included_files();

            foreach($included_files as $key => $filePath){

                $included_files[$key] = array();

                $fileExtension = Tools::getFileExtensionFromFilePath($filePath);

                $fileName = Tools::getFileNameFromFilePath($filePath);

                $included_files[$key]['name'] = $fileName;
                $included_files[$key]['extension'] = $fileExtension;

            }

            return $included_files;

        }

        public static function checkForIncluded($fileName){

            $includedFiles = Tools::getIncludedFiles();

            foreach($includedFiles as $key => $file){
                if($file['name'] == $fileName)
                return 1;
            }

            return 0;

        }

        public static function includeFile($filePath){

            require_once($filePath);
        }

        private static function getFileNameFromFilePath($filePath){

            $slashPosition = strrpos($filePath,'\\');

            $FileName = substr($filePath,$slashPosition+1);

            $FileName = substr($FileName,0,strlen($FileName)-4);

            unset($filePath);
            unset($slashPosition);

            return $FileName;
        }

        private static function getFileExtensionFromFilePath($FilePath){

            $extPosition = strrpos($FilePath,'.');

            $FileExtension = substr($FilePath,$extPosition+1);

            unset($FileName);
            unset($extPosition);

            return $FileExtension;
        }

    }


?>