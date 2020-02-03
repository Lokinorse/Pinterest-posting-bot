Pinterest posting bot
Bot that posts new pins to your pinterest from Google Spreadsheet

# Requirments
PHP 7.0 or above. To provide access to your Google Sheets file you must enable the Google Sheets API https://developers.google.com/sheets/api/quickstart/php?hl=ko

# Settings
*To set your spreadsheet to be parsed you need to change variable $spreadsheetId (googleSpreadsheetsSettings.php, line 68) to your spreadsheet's id. (you can find it in URL, it comes after "spreadsheets/d/")
*To set range of columns and rows to be parsed you need to change variable $range (googleSpreadsheetsSettings.php, line 69)
~~~
Note: Before exclamation mark comes the name of the list in your spreadsheet to be parsed   sd
~~~