$(document).ready(function(){
    function onScanSuccess(decodedText, decodedResult) {
        //pag magsuccess ung scan ito magrurun
        // handle the scanned code as you like, for example:
        console.log(`DecodedText: ${decodedText}\nDecodedResult: ${decodedResult}`);
        }

    let html5QrcodeScanner = new Html5QrcodeScanner("reader", { fps: 10, qrbox: {width: 250, height: 250} });
    html5QrcodeScanner.render(onScanSuccess, onScanFailure);

    function onScanFailure(error) {
        //pag mag error ung scan maglalabas siya ng error
        // handle scan failure, usually better to ignore and keep scanning.
        // for example:
        console.warn(`Code scan error = ${error}`);
        }
});