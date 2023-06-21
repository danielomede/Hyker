<script>
  let stepCount = 0;
  let isCounting = false;
  const stepThreshold = 20; // Adjusted acceleration magnitude threshold
  let sessionCode;
  let userReference; // Variable to store the user reference

  // Function to generate a random session code
  function generateSessionCode() {
    const sessionCodeLength = 10;
    const characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
    let code = '';
    for (let i = 0; i < sessionCodeLength; i++) {
      code += characters.charAt(Math.floor(Math.random() * characters.length));
    }
    return code;
  }

  function startStepFitProgram() {
    isCounting = true;
    sessionCode = generateSessionCode();
    document.getElementById('viewSteps').style.display = 'block';
    
    // Insert user's reference, stepfit reference, timestamp, and session code into the 'program_members' table
    userReference = '<?= $reference ?>'; // Replace with the actual user reference
    const stepFitReference = '7777777'; // Replace with the actual stepfit reference
    const timestamp = new Date().toISOString(); // Replace with the actual timestamp
    insertProgramMember(userReference, stepFitReference, sessionCode, timestamp);

    // Retrieve stepCount and caloriesBurned from localStorage if available
    const storedData = JSON.parse(localStorage.getItem('stepFitData'));
    if (storedData && storedData.sessionCode === sessionCode) {
      stepCount = storedData.stepCount;
      updateStepCountDisplay();
      updateCaloriesBurned();
      console.log('Step count and calories burned retrieved from localStorage');
    }
  }

  function stopStepFitProgram() {
    isCounting = false;
    saveStepCountAndCaloriesToLocalStorage();
  }

  function updateStepCountDisplay() {
    document.getElementById('stepCountDisplay').innerText = stepCount;
    saveStepCountAndCaloriesToLocalStorage();
  }

  function updateCaloriesBurned() {
    const gender = '<?= $gender ?>'; // Replace with the user's gender ('male' or 'female')
    const height = <?= $height ?>; // Replace with the user's height in centimeters
    const age = <?= $age ?>; // Replace with the user's age in years
    const weight = <?= $weightInKg ?>; // Replace with the user's weight in kilograms

    const caloriesBurned = convertStepsToCalories(stepCount, gender, height, age, weight);
    document.getElementById('viewstepCalories').innerHTML = caloriesBurned.toFixed(2); // Display calories with 2 decimal places
    saveStepCountAndCaloriesToLocalStorage(caloriesBurned);
  }

  function saveStepCountAndCaloriesToLocalStorage(caloriesBurned) {
    const data = {
      sessionCode: sessionCode,
      stepCount: stepCount,
      caloriesBurned: caloriesBurned
    };
    localStorage.setItem('stepFitData', JSON.stringify(data));
    // Additionally, update the step count and calories burned in the database
    updateProgramMemberData(userReference, sessionCode, stepCount, caloriesBurned);
  }

  window.addEventListener("devicemotion", (event) => {
    console.log(`${event.acceleration.x} m/s2`);

    if (isCounting) {
      const acceleration = event.acceleration || event.accelerationIncludingGravity;
      const accelerationMagnitude = Math.sqrt(
        Math.pow(acceleration.x, 2) +
        Math.pow(acceleration.y, 2) +
        Math.pow(acceleration.z, 2)
      );

      // Detect a step based on the adjusted acceleration magnitude threshold
      if (accelerationMagnitude > stepThreshold) {
        stepCount++;
        updateStepCountDisplay();
        updateCaloriesBurned();
      }
    }
  });

  window.addEventListener("beforeunload", () => {
    saveStepCountAndCaloriesToLocalStorage(convertStepsToCalories(stepCount, gender, height, age, weight));
  });

  // Function to update the step count and calories burned in the 'program_members' table
  function updateProgramMemberData(userReference, sessionCode, stepCount, caloriesBurned) {
    // Prepare the data to send
    const data = {
      userReference: userReference,
      sessionCode: sessionCode,
      stepCount: stepCount,
      caloriesBurned: caloriesBurned
    };

    // Make an AJAX request to the server-side PHP script
    fetch('update_step_count.php', {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json'
      },
      body: JSON.stringify(data)
    })
      .then(response => response.json())
      .then(result => {
        console.log(result.message);
      })
      .catch(error => {
        console.error('Error updating program member data:', error);
      });
  }

  function insertProgramMember(userReference, stepFitReference, sessionCode, timestamp) {
    // Create a new XMLHttpRequest object
    var xhr = new XMLHttpRequest();

    // Prepare the data to be sent in the POST request
    var data = {
      userReference: userReference,
      stepFitReference: stepFitReference,
      sessionCode: sessionCode,
      timestamp: timestamp
    };

    // Set the request URL and method
    xhr.open('POST', 'save_step_count.php', true);

    // Set the request header
    xhr.setRequestHeader('Content-Type', 'application/json');

    // Define the onload callback function
    xhr.onload = function() {
      if (xhr.status === 200) {
        // Handle the successful response from the server
        console.log(xhr.responseText);
      } else {
        // Handle the error response from the server
        console.error('Error inserting program member:', xhr.status);
      }
    };

    // Convert the data to JSON format and send the request
    xhr.send(JSON.stringify(data));
  }
  
  function convertStepsToCalories(stepCount, gender, height, age, weight) {
  const caloriesPerStep = 0.05; // Calories burned per step
  const caloriesBurnedPerKg = 0.034; // Calories burned per kilogram per step
  const ageFactor = age >= 18 ? 0.2017 : 0.074;
  const caloriesBurned = stepCount * caloriesPerStep * weight * ageFactor;

  return caloriesBurned;
}


  function calculateStrideLength(height, gender) {
    // Calculation of stride length based on height and gender
    // Adjust the formula according to your specific calculation
    let strideLength;
    if (gender === 'male') {
      strideLength = height * 0.415;
    } else if (gender === 'female') {
      strideLength = height * 0.413;
    } else {
      // Default stride length if gender is not specified
      strideLength = height * 0.414;
    }

    return strideLength;
  }

  // Check for previous step count and calories burned when the page loads
  window.addEventListener("load", () => {
    const storedData = JSON.parse(localStorage.getItem('stepFitData'));
    if (storedData && storedData.sessionCode) {
      stepCount = storedData.stepCount;
      updateStepCountDisplay();
      updateCaloriesBurned();
      startStepFitProgram(); // Start the program if data is available
    }
  });
</script>
