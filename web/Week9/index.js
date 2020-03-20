const bodyParser = require('body-parser');

const express = require('express');
const app = express();
const port = process.env.PORT || 5000;

// tell it to use the public directory as one where static files live
app.use(express.static(__dirname + '/public'));

// views is directory for all template files
app.set('views', __dirname + '/views');
app.set('view engine', 'ejs');

// set up a rule that says requests to "/math" should be handled by the
// handleMath function below
app.get('/math', handleMath);

// start the server listening
app.listen(port, function() {
  console.log('Node app is running on port', port);
});


/**********************************************************************
 * Ideally the functions below here would go into a different file
 * but for ease of reading this example and seeing all of the pieces
 * they are listed here.
 **********************************************************************/

function handleMath(request, response) {
	const mailType = request.query.operation;
	const weight = Number(request.query.operand1);

	// TODO: Here we should check to make sure we have all the correct parameters

	computeOperation(response, mailType, weight);
}

function computeOperation(response, type, size) {
	type = escape(type).toLowerCase();

	let result = 0;

	if (type == "stamped%20letter") {
		if (size <= 1)
		{
			result = 0.55;
		}
		else if (size <= 2)
		{
			result = 0.70;
		}
		else if (size <= 3)
		{
			result = 0.85;
		}
		else if (size <= 3.5)
		{
			result = 1.00;
		}
		else if (size > 3.5)
		{
			result = "Too big for this mail type!";
		}
	} else if (type == "metered%20letter") {
		if (size <= 1)
		{
			result = 0.50;
		}
		else if (size <= 2)
		{
			result = 0.65;
		}
		else if (size <= 3)
		{
			result = 0.80;
		}
		else if (size <= 3.5)
		{
			result = 0.95;
		}
		else if (size > 3.5)
		{
			result = "Too big for this mail type!";
		}		
	} else if (type == "large%20flat%20envelope") {
		if (size <= 1)
		{
			result = 1.00;
		}
		else if (size <= 2)
		{
			result = 1.20;
		}
		else if (size <= 3)
		{
			result = 1.40;
		}
		else if (size <= 4)
		{
			result = 1.60;
		}
		else if (size <= 5)
		{
			result = 1.80;
		}
		else if (size <= 6)
		{
			result = 2.00;
		}
		else if (size <= 7)
		{
			result = 2.20;
		}
		else if (size <= 8)
		{
			result = 2.40;
		}
		else if (size <= 9)
		{
			result = 2.60;
		}
		else if (size <= 10)
		{
			result = 2.80;
		}
		else if (size <= 11)
		{
			result = 3.00;
		}
		else if (size <= 12)
		{
			result = 3.20;
		}
		else if (size <= 13)
		{
			result = 3.40;
		}
		else if (size > 13)
		{
			result = "Too big for this mail type!";
		}
	} else if (type == "first-class%20package%20service-retail") {
		if (size <= 1)
		{
			result = 4.20;
		}
		else if (size <= 2)
		{
			result = 4.20;
		}
		else if (size <= 3)
		{
			result = 4.20;
		}
		else if (size <= 4)
		{
			result = 4.20;
		}
		else if (size <= 5)
		{
			result = 5.00;
		}
		else if (size <= 6)
		{
			result = 5.00;
		}
		else if (size <= 7)
		{
			result = 5.00;
		}
		else if (size <= 8)
		{
			result = 5.00;
		}
		else if (size <= 9)
		{
			result = 5.75;
		}
		else if (size <= 10)
		{
			result = 5.75;
		}
		else if (size <= 11)
		{
			result = 5.75;
		}
		else if (size <= 12)
		{
			result = 5.75;
		}
		else if (size <= 13)
		{
			result = 6.50;
		}
		else if (size > 13)
		{
			result = "Too big for this mail type!";
		}
	} else {
		// It would be best here to redirect to an "unknown operation"
		// error page or something similar.
	}

	// Set up a JSON object of the values we want to pass along to the EJS result page
	const params = {mailType: type, weight: size, result: result};

	// Render the response, using the EJS page "result.ejs" in the pages directory
	// Makes sure to pass it the parameters we need.
	response.render('pages/result', params);

}