<?php

namespace App\Controller;

use App\Repository\UserRepository;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class ExportController extends AbstractController
{
    /**
     * @Route("/export/users", name="app_users_export")
     */
    public function index(UserRepository $userRepository): Response
    {
        $physicians = $userRepository->getByRole("ROLE_PHYSICIAN");
        $dataManagers = $userRepository->getByRole("ROLE_DATA_MANAGER");
        // Préparation de l'xls
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->setTitle("Physicians");
        // Mise en place des entêtes
        $sheet->getCell('A1')->setValue("Name");
        $sheet->getCell('B1')->setValue('Firstmane');
        $sheet->getCell('C1')->setValue("Institution");
        $sheet->getCell('D1')->setValue('Email');
        $sheet->getCell('E1')->setValue('Business Adress');
        $sheet->getCell('F1')->setValue('City');
        $sheet->getCell('G1')->setValue('Zipcode');
        $sheet->getCell('H1')->setValue('Country');
        $sheet->getCell('I1')->setValue('Mobile phone');
        $sheet->getCell('J1')->setValue('Waiting Certificate');
        $sheet->getCell('K1')->setValue('Attending Meeting');
        $sheet->getCell('L1')->setValue('Remotely');
        $sheet->getCell('M1')->setValue('Need train');
        $sheet->getCell('N1')->setValue('Need flight');
        // $sheet->getCell('O1')->setValue('Need hostel');
        $sheet->getCell('O1')->setValue('Train station');
        $sheet->getCell('P1')->setValue('Airport');
        // Mise en place des datas
        $datas = [];
        foreach ($physicians as $physician) {
            $datas[] = [
                $physician->getName(),
                $physician->getFirstname(),
                $physician->getInstitutionName(),
                $physician->getEmail(),
                $physician->getBusinessAddress(),
                $physician->getCity(),
                $physician->getZipcode(),
                $physician->getCountry(),
                $physician->getMobilePhone(),
                $physician->getIsWaitingCertificate(),
                $physician->getIsAttendingMeeting(),
                $physician->getIsRemotely(),
                $physician->getIsNeedTrain(),
                $physician->getIsNeedFlight(),
                // $physician->getIsNeedHotel(),
                $physician->getTrainStation(),
                $physician->getAirport(),
            ];
        }
        $sheet->fromArray($datas, null, 'A2', true);
        foreach (range('A', 'P') as $columnID) {
            $spreadsheet->getActiveSheet()->getColumnDimension($columnID)->setAutoSize(true);
        }
        // DATA MANAGES
        $dataManagerSheet = new Worksheet($spreadsheet, "Data managers");
        $spreadsheet->addSheet($dataManagerSheet, 1);
        // Mise en place des entêtes
        $dataManagerSheet->getCell('A1')->setValue("Name");
        $dataManagerSheet->getCell('B1')->setValue('Firstmane');
        $dataManagerSheet->getCell('C1')->setValue("Institution");
        $dataManagerSheet->getCell('D1')->setValue('Email');
        $dataManagerSheet->getCell('E1')->setValue('Business Adress');
        $dataManagerSheet->getCell('F1')->setValue('City');
        $dataManagerSheet->getCell('G1')->setValue('Zipcode');
        $dataManagerSheet->getCell('H1')->setValue('Country');
        $dataManagerSheet->getCell('I1')->setValue('Mobile phone');
        $dataManagerSheet->getCell('J1')->setValue('Waiting Certificate');
        $dataManagerSheet->getCell('K1')->setValue('Attending Meeting');
        $dataManagerSheet->getCell('L1')->setValue('Remotely');
        $dataManagerSheet->getCell('M1')->setValue('Need train');
        $dataManagerSheet->getCell('N1')->setValue('Need flight');
        // $dataManagerSheet->getCell('O1')->setValue('Need hostel');
        $dataManagerSheet->getCell('O1')->setValue('Train station');
        $dataManagerSheet->getCell('P1')->setValue('Airport');
        // Mise en place des datas
        $datas = [];
        foreach ($dataManagers as $dataManager) {
            $datas[] = [
                $dataManager->getName(),
                $dataManager->getFirstname(),
                $dataManager->getInstitutionName(),
                $dataManager->getEmail(),
                $dataManager->getBusinessAddress(),
                $dataManager->getCity(),
                $dataManager->getZipcode(),
                $dataManager->getCountry(),
                $dataManager->getMobilePhone(),
                $dataManager->getIsWaitingCertificate(),
                $dataManager->getIsAttendingMeeting(),
                $dataManager->getIsRemotely(),
                $dataManager->getIsNeedTrain(),
                $dataManager->getIsNeedFlight(),
                // $dataManager->getIsNeedHotel(),
                $dataManager->getTrainStation(),
                $dataManager->getAirport(),
            ];
        }
        $dataManagerSheet->fromArray($datas, null, 'A2', true);
        foreach (range('A', 'P') as $columnID) {
            $spreadsheet->getActiveSheet()->getColumnDimension($columnID)->setAutoSize(true);
        }
        // Génération et sauvegarde du fichier excell
        $writer = new Xlsx($spreadsheet);
        $path = 'xls/export_users.xlsx';
        $writer->save($path);
        // Réponse
        return $this->redirect('/' . $path);
    }
}
