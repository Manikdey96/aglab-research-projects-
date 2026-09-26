<?php

namespace Database\Seeders;

use App\Models\ResearchProject;
use Illuminate\Database\Seeder;

class ResearchProjectSeeder extends Seeder
{
    public function run(): void
    {
        $projects = [
            [
                'title' => 'Identification of Stress-Responsive Genes in Crop and Vegetable Species',
                'description' => 'Finding candidate stress responsive genes in crop and vegetable plant species to understand molecular mechanisms behind plant stress tolerance.',
                'principal_investigator' => 'Dr. Ajit Ghosh',
                'research_area' => 'Plant Abiotic Stress Biology',
                'funding_source' => 'SUST Research Center',
                'budget' => 500000,
                'status' => 'ongoing',
                'start_date' => '2024-01-15',
                'end_date' => null,
            ],
            [
                'title' => 'Antibiotic Resistance Modulation Using Phytochemical Adjuvants',
                'description' => 'Exploring how plant-derived bioactive compounds may enhance or support antibiotic activity against microorganisms.',
                'principal_investigator' => 'Dr. Ajit Ghosh',
                'research_area' => 'Soil Microbiota and Plant-Microbe Interaction',
                'funding_source' => 'Ministry of Science and Technology',
                'budget' => 800000,
                'status' => 'ongoing',
                'start_date' => '2023-07-01',
                'end_date' => null,
            ],
            [
                'title' => 'Whole Genome Analysis of Soil Microorganisms',
                'description' => 'Whole genome sequencing and comparative analysis of soil-associated microorganisms relevant to plant-microbe interactions.',
                'principal_investigator' => 'Dr. Ajit Ghosh',
                'research_area' => 'Whole Genome Analysis of Microorganisms',
                'funding_source' => 'University Grants Commission',
                'budget' => 650000,
                'status' => 'completed',
                'start_date' => '2022-03-01',
                'end_date' => '2023-12-31',
            ],
            [
                'title' => 'Machine Learning Model for Skin Disease Detection',
                'description' => 'Developing computational models combining experimental biology with machine learning for automated skin disease detection.',
                'principal_investigator' => 'Dr. Ajit Ghosh',
                'research_area' => 'Machine Learning for Diagnostic Purpose & Drug Designing',
                'funding_source' => 'Internal Lab Fund',
                'budget' => 300000,
                'status' => 'upcoming',
                'start_date' => '2027-01-01',
                'end_date' => null,
            ],
        ];

        foreach ($projects as $project) {
            ResearchProject::create($project);
        }
    }
}
