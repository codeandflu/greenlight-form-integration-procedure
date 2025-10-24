

// Replace with your actual sheet name
var SHEET_NAME = "Sheet1";

function doPost(e) {
  try {
    var ss = SpreadsheetApp.getActiveSpreadsheet();
    var sheet = ss.getSheetByName(SHEET_NAME);

    // Parse form fields
    var name = e.parameter.name || '';
    var email = e.parameter.email || '';
    var message = e.parameter.message || '';
    var date = new Date();

    // Append a new row
    sheet.appendRow([date, name, email, message]);

    // Return success response
    return ContentService.createTextOutput(JSON.stringify({
      'status': 'success',
      'message': 'Data added'
    })).setMimeType(ContentService.MimeType.JSON);

  } catch(err) {
    return ContentService.createTextOutput(JSON.stringify({
      'status': 'error',
      'message': err.message
    })).setMimeType(ContentService.MimeType.JSON);
  }
}


