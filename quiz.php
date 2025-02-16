<?php
session_start();

// Ensure domain and level are passed via the URL
$domain = isset($_GET['domain']) ? $_GET['domain'] : null;
$level = isset($_GET['level']) ? $_GET['level'] : null;

// Redirect if the domain or level is invalid
$validDomains = ['Climate Action', 'Water Management', 'Renewable Energy', 'Sustainable Recycling', 'Sustainable Agriculture'];
$validLevels = ['beginner', 'intermediate', 'advanced'];

if (!in_array($domain, $validDomains) || !in_array($level, $validLevels)) {
    header('Location: index.php'); // Or a specific page that lists the domains
    exit;
}
$timeLimit = 5 * 60;
// Sample questions (could be stored in a database for better flexibility)
$questions = [
    'Climate Action' => [
        'beginner' => [
            ['question' => 'What is the primary cause of climate change?', 'options' => ['Human activity', 'Natural causes', 'Both'], 'correct' => 0],
            ['question' => 'What is renewable energy?', 'options' => ['Energy from non-renewable sources', 'Energy from natural resources that regenerate', 'Energy stored in batteries'], 'correct' => 0],
            ['question' => 'What is a carbon footprint?', 'options' => ['The amount of carbon in the atmosphere', 'The environmental impact of human activities', 'A measurement of CO2 emissions from forests'], 'correct' => 0],
            ['question' => 'Which of these is a greenhouse gas?', 'options' => ['Oxygen', 'Carbon dioxide', 'Nitrogen'], 'correct' => 0],
            ['question' => 'What is the greenhouse effect?', 'options' => ['A natural process that warms the Earth', 'The release of toxic gases', 'A cooling effect caused by pollution'], 'correct' => 0],
        ],
        'intermediate' => [
            ['question' => 'What is the Paris Agreement?', 'options' => ['A climate change treaty aiming to limit global warming', 'A renewable energy initiative', 'A trade agreement between countries'], 'correct' => 0],
            ['question' => 'Which country produces the most carbon dioxide emissions?', 'options' => ['China', 'USA', 'India'], 'correct' => 0],
            ['question' => 'Which sector is the largest contributor to global greenhouse gas emissions?', 'options' => ['Transportation', 'Agriculture', 'Energy production'], 'correct' => 0],
            ['question' => 'Which is an example of a carbon capture technology?', 'options' => ['Wind turbines', 'Carbon capture and storage (CCS)', 'Solar panels'], 'correct' => 0],
            ['question' => 'What is the role of forests in climate action?', 'options' => ['Forests absorb CO2', 'Forests release methane', 'Forests contribute to urban heat islands'], 'correct' => 0],
        ],
        'advanced' => [
            ['question' => 'What is the concept of "climate justice"?', 'options' => ['An approach to address the disproportionate impacts of climate change on vulnerable groups', 'The idea of protecting forests', 'The creation of renewable energy infrastructure'], 'correct' => 0],
            ['question' => 'Which of the following is a major consequence of climate change?', 'options' => ['Sea level rise', 'More rainfall in deserts', 'Higher oxygen levels in the atmosphere'], 'correct' => 0],
            ['question' => 'What is the role of geoengineering in addressing climate change?', 'options' => ['Large-scale intervention to counteract climate change effects', 'Reducing the carbon footprint', 'Minimizing greenhouse gas emissions through regulation'], 'correct' => 0],
            ['question' => 'Which organization monitors and tracks global CO2 emissions?', 'options' => ['IPCC', 'NASA', 'WMO'], 'correct' => 0],
            ['question' => 'What is a carbon budget?', 'options' => ['The total amount of CO2 emissions we can afford before exceeding climate targets', 'The total carbon emissions from forests', 'A government limit on carbon production'], 'correct' => 0],
        ],
    ],
    
    'Water Management' => [
        'beginner' => [
            ['question' => 'What is the main source of fresh water?', 'options' => ['Rivers', 'Rain', 'Underground aquifers'], 'correct' => 0],
            ['question' => 'What is water conservation?', 'options' => ['Saving water by reducing wastage', 'Using water more efficiently', 'Both'], 'correct' => 0],
            ['question' => 'Which of these is a method of water purification?', 'options' => ['Boiling', 'Filtration', 'All of the above'], 'correct' => 0],
            ['question' => 'What does "greywater" refer to?', 'options' => ['Water from toilets', 'Water from washing machines, sinks, and showers', 'Rainwater'], 'correct' => 0],
            ['question' => 'Which country has the highest water consumption per capita?', 'options' => ['USA', 'China', 'India'], 'correct' => 0],
        ],
        'intermediate' => [
            ['question' => 'What is the term for removing salts from seawater?', 'options' => ['Desalination', 'Filtration', 'Purification'], 'correct' => 0],
            ['question' => 'Which of these is a major threat to global freshwater resources?', 'options' => ['Pollution', 'Climate change', 'Over-extraction of water'], 'correct' => 2],
            ['question' => 'What is the goal of integrated water resources management (IWRM)?', 'options' => ['Sustainable management of water resources', 'Increasing water extraction for agriculture', 'Building more reservoirs'], 'correct' => 0],
            ['question' => 'What is a watershed?', 'options' => ['A body of water', 'A geographical area where water drains into a river', 'A water treatment plant'], 'correct' => 1],
            ['question' => 'What is aquifer depletion?', 'options' => ['The use of surface water for irrigation', 'The decline of underground water reserves', 'The desalination of seawater'], 'correct' => 1],
        ],
        'advanced' => [
            ['question' => 'What is the concept of virtual water?', 'options' => ['The amount of water used in the production of goods and services', 'Water that evaporates from water bodies', 'Water stored underground'], 'correct' => 0],
            ['question' => 'What is the role of wetlands in water management?', 'options' => ['Filtering and purifying water', 'Reducing groundwater recharge', 'Increasing water pollution'], 'correct' => 0],
            ['question' => 'Which technology helps in reducing water wastage in agriculture?', 'options' => ['Drip irrigation', 'Flood irrigation', 'Dams'], 'correct' => 0],
            ['question' => 'What is an aquifer?', 'options' => ['A river', 'A layer of water-storing rock', 'A water treatment facility'], 'correct' => 1],
            ['question' => 'What is the main challenge of water scarcity in cities?', 'options' => ['Pollution', 'Overpopulation', 'Climate change'], 'correct' => 1],
        ],
    ],
    
    'Renewable Energy' => [
        'beginner' => [
            ['question' => 'What is renewable energy?', 'options' => ['Energy from natural resources that regenerate', 'Energy stored in batteries', 'Energy from fossil fuels'], 'correct' => 0],
            ['question' => 'Which is a common renewable energy source?', 'options' => ['Solar power', 'Nuclear power', 'Coal'], 'correct' => 0],
            ['question' => 'What is solar power?', 'options' => ['Energy from the sun', 'Energy from wind', 'Energy from waves'], 'correct' => 0],
            ['question' => 'What does "wind power" use to generate electricity?', 'options' => ['Wind turbines', 'Solar panels', 'Dams'], 'correct' => 0],
            ['question' => 'Which energy source is not renewable?', 'options' => ['Wind', 'Natural gas', 'Hydropower'], 'correct' => 1],
        ],
        'intermediate' => [
            ['question' => 'What is a photovoltaic cell?', 'options' => ['A device that converts sunlight into electricity', 'A device that stores solar energy', 'A device that collects wind energy'], 'correct' => 0],
            ['question' => 'What is bioenergy?', 'options' => ['Energy derived from living organisms', 'Energy from the ocean', 'Energy from underground resources'], 'correct' => 0],
            ['question' => 'Which of these is a drawback of wind energy?', 'options' => ['Wind is not always consistent', 'Wind turbines can harm wildlife', 'Both'], 'correct' => 2],
            ['question' => 'What is hydropower?', 'options' => ['Power generated from water flow', 'Power generated from the earth', 'Power generated from sunlight'], 'correct' => 0],
            ['question' => 'What is geothermal energy?', 'options' => ['Energy from the earth\'s heat', 'Energy from the ocean', 'Energy from biofuel'], 'correct' => 0],
        ],
        'advanced' => [
            ['question' => 'What is grid energy storage?', 'options' => ['Storing energy to balance supply and demand', 'Storing energy in solar panels', 'Storing energy in batteries only'], 'correct' => 0],
            ['question' => 'What is the main advantage of offshore wind farms?', 'options' => ['Consistent wind speeds', 'Land conservation', 'Lower electricity costs'], 'correct' => 0],
            ['question' => 'What is a major challenge of solar power?', 'options' => ['Energy storage', 'Energy cost', 'Solar panel efficiency'], 'correct' => 0],
            ['question' => 'Which country is a leader in geothermal energy use?', 'options' => ['Iceland', 'USA', 'China'], 'correct' => 0],
            ['question' => 'What is a major environmental concern with bioenergy?', 'options' => ['Air pollution', 'Deforestation', 'Water pollution'], 'correct' => 1],
        ],
    ],
    
    'Sustainable Recycling' => [
        'beginner' => [
            ['question' => 'What is recycling?', 'options' => ['Turning waste into reusable materials', 'Burning waste', 'Discarding waste'], 'correct' => 0],
            ['question' => 'Which material is recyclable?', 'options' => ['Plastic', 'Paper', 'All of the above'], 'correct' => 2],
            ['question' => 'Why is recycling important?', 'options' => ['Conserves resources', 'Reduces pollution', 'Both'], 'correct' => 2],
            ['question' => 'Which item should not be recycled?', 'options' => ['Empty plastic bottles', 'Used tissues', 'Cardboard'], 'correct' => 1],
            ['question' => 'What is composting?', 'options' => ['Recycling organic waste', 'Recycling metals', 'Recycling plastic'], 'correct' => 0],
        ],
        'intermediate' => [
            ['question' => 'What is the recycling process for metals?', 'options' => ['Melting and re-forming', 'Shredding and reusing', 'Turning it into liquid'], 'correct' => 0],
            ['question' => 'What is e-waste?', 'options' => ['Electronic waste', 'Wood waste', 'Plastic waste'], 'correct' => 0],
            ['question' => 'What is upcycling?', 'options' => ['Reusing old items for new purposes', 'Turning waste into energy', 'Recycling plastic'], 'correct' => 0],
            ['question' => 'What is the impact of plastic waste on the environment?', 'options' => ['Harm to marine life', 'Air pollution', 'Ozone depletion'], 'correct' => 0],
            ['question' => 'Which recycling symbol represents plastics?', 'options' => ['♻️', '♻️#2', '♻️#1'], 'correct' => 1],
        ],
        'advanced' => [
            ['question' => 'What is closed-loop recycling?', 'options' => ['Recycling where materials can be reused indefinitely', 'Recycling waste in landfills', 'Recycling mixed waste'], 'correct' => 0],
            ['question' => 'What is downcycling?', 'options' => ['Turning waste into a less useful product', 'Turning waste into energy', 'Turning waste into high-value products'], 'correct' => 0],
            ['question' => 'What is the concept of circular economy?', 'options' => ['Reusing, recycling, and reducing waste', 'Increasing production and consumption', 'Burning all waste'], 'correct' => 0],
            ['question' => 'How can the public be encouraged to recycle more effectively?', 'options' => ['By increasing awareness and making recycling easy', 'By limiting recycling options', 'By adding fees to recycling services'], 'correct' => 0],
            ['question' => 'What is the significance of the recycling triangle symbol?', 'options' => ['It indicates recyclable materials', 'It indicates non-recyclable materials', 'It indicates biodegradable materials'], 'correct' => 0],
        ],
    ],
    
    'Sustainable Agriculture' => [
        'beginner' => [
            ['question' => 'What is sustainable agriculture?', 'options' => ['Agriculture that meets the needs of the present without compromising future generations', 'Agriculture that focuses on producing high yields', 'Agriculture that uses synthetic fertilizers'], 'correct' => 0],
            ['question' => 'What is organic farming?', 'options' => ['Farming without synthetic pesticides or fertilizers', 'Farming with a focus on profit', 'Farming using genetically modified organisms'], 'correct' => 0],
            ['question' => 'Which of these is an example of sustainable farming?', 'options' => ['Crop rotation', 'Monoculture', 'Heavy use of pesticides'], 'correct' => 0],
            ['question' => 'Why is biodiversity important for agriculture?', 'options' => ['It improves soil quality and pest control', 'It reduces crop yields', 'It increases the cost of production'], 'correct' => 0],
            ['question' => 'What is agroforestry?', 'options' => ['Integrating trees into agricultural systems', 'Using only chemical fertilizers', 'Growing crops in greenhouses'], 'correct' => 0],
        ],
        'intermediate' => [
            ['question' => 'What is crop rotation?', 'options' => ['Planting different crops in the same field each year', 'Planting the same crops in the same field every year', 'Using the same crop in multiple seasons'], 'correct' => 0],
            ['question' => 'What is the primary benefit of cover crops?', 'options' => ['Prevent soil erosion', 'Increase pesticide use', 'Increase water consumption'], 'correct' => 0],
            ['question' => 'What is integrated pest management (IPM)?', 'options' => ['A combination of natural and chemical pest control methods', 'Using only pesticides for pest control', 'Using natural predators only'], 'correct' => 0],
            ['question' => 'What is the concept of permaculture?', 'options' => ['Designing agricultural systems to mimic natural ecosystems', 'Using synthetic chemicals for farming', 'Building large-scale farms'], 'correct' => 0],
            ['question' => 'Why is water management important in sustainable farming?', 'options' => ['To ensure efficient irrigation and reduce water wastage', 'To increase water consumption for crops', 'To use only rainwater for farming'], 'correct' => 0],
        ],
        'advanced' => [
            ['question' => 'What is regenerative agriculture?', 'options' => ['Farming practices aimed at restoring soil health and biodiversity', 'Farming that increases yields using chemicals', 'Farming without using water'], 'correct' => 0],
            ['question' => 'What is aquaponics?', 'options' => ['A system that combines fish farming with hydroponics', 'A system that uses only fish waste as fertilizer', 'A system that grows crops in soil'], 'correct' => 0],
            ['question' => 'What is agroecology?', 'options' => ['The study of ecological processes in agricultural systems', 'Using genetically modified organisms', 'Using monocultures'], 'correct' => 0],
            ['question' => 'What is the role of soil microbiomes in sustainable agriculture?', 'options' => ['They enhance soil health and fertility', 'They reduce the need for irrigation', 'They decrease the need for pesticides'], 'correct' => 0],
            ['question' => 'What is the importance of carbon sequestration in agriculture?', 'options' => ['Capturing carbon dioxide in the soil to mitigate climate change', 'Reducing the number of livestock', 'Increasing the use of synthetic fertilizers'], 'correct' => 0],
        ],
    ],
];


// Fetch questions based on the domain and level
$quizQuestions = isset($questions[$domain][$level]) ? $questions[$domain][$level] : [];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $score = 0;
    // Loop through each question to check the answers
    foreach ($quizQuestions as $index => $question) {
        if (isset($_POST['answer'][$index]) && $_POST['answer'][$index] == $question['correct']) {
            $score++;
        }
    }

    // Save the score in session
    $_SESSION['progress'][$domain][$level]['score'] = $score;

    // If score is 4 or more, mark the level as completed
    if ($score >= 4) {
        $_SESSION['progress'][$domain][$level]['completed'] = true;
    }

    // Redirect to result page
    header("Location:http://localhost:8080/educateu/tests.php?domain=$domain&level=$level&score=$score");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $domain . ' - ' . ucfirst($level) . ' Quiz'; ?></title>
    <style>
        /* General Styles */
        body {
            font-family: 'Arial', sans-serif;
            background: linear-gradient(135deg, #2e8b57, #f7f9f8);
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            color: #084b23;
            box-sizing: border-box;
        }

        .container {
            background: rgba(255, 255, 255, 0.9);
            padding: 40px;
            border-radius: 20px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 800px;
            text-align: center;
            backdrop-filter: blur(8px);
            border: 2px solid #fff;
        }

        h1 {
            font-size: 2.8rem;
            color: #2e8b57;
            margin-bottom: 30px;
            font-weight: 700;
            letter-spacing: 1px;
            text-transform: capitalize;
        }

        .question {
            margin: 25px 0;
            background: rgba(255, 255, 255, 0.8);
            padding: 15px;
            border-radius: 10px;
            box-shadow: 0 5px 10px rgba(0, 0, 0, 0.1);
        }

        .question h3 {
            font-size: 1.5rem;
            color: #333;
            margin-bottom: 15px;
            font-weight: bold;
        }

        label {
            display: block;
            margin: 15px 0;
            font-size: 1.1rem;
            color: #555;
            padding: 10px;
            border-radius: 5px;
            background-color: #f0f8f0;
            cursor: pointer;
            transition: background-color 0.3s ease, transform 0.2s ease;
        }

        label:hover {
            background-color: #d9f7d6;
            transform: scale(1.05);
        }

        input[type="radio"] {
            margin-right: 10px;
        }

        .btn {
            display: inline-block;
            padding: 12px 28px;
            font-size: 1.2rem;
            color: #fff;
            background: linear-gradient(135deg, #4caf50, #45a049);
            border-radius: 30px;
            text-decoration: none;
            cursor: pointer;
            transition: background 0.3s ease, transform 0.3s ease;
            margin-top: 20px;
        }

        .btn:hover {
            background: linear-gradient(135deg, #45a049, #4caf50);
            transform: scale(1.05);
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .container {
                padding: 25px;
            }

            h1 {
                font-size: 2rem;
            }

            .question h3 {
                font-size: 1.3rem;
            }

            .btn {
                font-size: 1rem;
                padding: 10px 20px;
            }
        }
    </style>
</head>
<body>

    <div class="container">
        <h1><?php echo $domain . ' - ' . ucfirst($level) . ' Quiz'; ?></h1>
        <form method="POST">
            <?php foreach ($quizQuestions as $index => $question): ?>
                <div class="question">
                    <h3><?php echo $question['question']; ?></h3>
                    <?php foreach ($question['options'] as $optionIndex => $option): ?>
                        <label>
                            <input type="radio" name="answer[<?php echo $index; ?>]" value="<?php echo $optionIndex; ?>" required>
                            <?php echo $option; ?>
                        </label>
                    <?php endforeach; ?>
                </div>
            <?php endforeach; ?>
            <button type="submit" class="btn">Submit</button>
        </form>
    </div>

</body>
</html>
