<?php

namespace App\Outputs;

use App\Outputs\ProfileFormatter;

class TextFormat implements ProfileFormatter
{
    private $response;

    public function setData($profile)
    {
        // Basic Info
        $output = "Full Name: " . $profile->getFullName() . PHP_EOL;
        $output .= "Email: " . $profile->getContactDetails()['email'] . PHP_EOL;
        $output .= "Phone: " . $profile->getContactDetails()['phone_number'] . PHP_EOL;
        $output .= "Address: " . implode(", ", $profile->getContactDetails()['address']) . PHP_EOL;
        
        // Education
        $output .= "Education: " . $profile->getEducation()['degree'] . " at " . $profile->getEducation()['university'] . PHP_EOL;

        // Skills
        $output .= "Skills: " . implode(", ", $profile->getSkills()) . PHP_EOL;

        // Experience
        $output .= PHP_EOL . "Experience:" . PHP_EOL;
        foreach ($profile->getExperience() as $job) {
            $output .= "- " . $job['job_title'] . " at " . $job['company'] . " (" . $job['start_date'] . " to " . $job['end_date'] . ")" . PHP_EOL;
        }

        // Certifications
        $output .= PHP_EOL . "Certifications:" . PHP_EOL;
        foreach ($profile->getCertifications() as $certification) {
            $output .= "- " . $certification['name'] . " (Earned on: " . $certification['date_earned'] . ")" . PHP_EOL;
        }

        // Extra-Curricular Activities
        $output .= PHP_EOL . "Extra-Curricular Activities:" . PHP_EOL;
        foreach ($profile->getExtraCurricularActivities() as $activity) {
            $output .= "- " . $activity['role'] . " at " . $activity['organization'] . " (" . $activity['start_date'] . " to " . $activity['end_date'] . ")" . PHP_EOL;
            $output .= "  " . $activity['description'] . PHP_EOL;
        }

        // Languages
        $output .= PHP_EOL . "Languages:" . PHP_EOL;
        foreach ($profile->getLanguages() as $language) {
            $output .= "- " . $language['language'] . " (" . $language['proficiency'] . ")" . PHP_EOL;
        }

        // References
        $output .= PHP_EOL . "References:" . PHP_EOL;
        foreach ($profile->getReferences() as $reference) {
            $output .= "- " . $reference['name'] . ", " . $reference['position'] . " at " . $reference['company'] . PHP_EOL;
            $output .= "  Email: " . $reference['email'] . " | Phone: " . $reference['phone_number'] . PHP_EOL;
        }

        // Set the response
        $this->response = $output;
    }

    public function render()
    {
        header('Content-Type: text/plain');
        return $this->response;
    }
}
