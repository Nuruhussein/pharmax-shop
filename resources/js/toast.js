// Define a global function to show toast notifications
function showToast(message, type = "success") {
    let backgroundColor = "linear-gradient(to right, #00b09b, #96c93d)"; // Default success color
    if (type === "error") {
        backgroundColor = "linear-gradient(to right, #ff5f6d, #ffc371)"; // Error color
    }

    Toastify({
        text: message,
        backgroundColor: backgroundColor,
        duration: 3000,
    }).showToast();
}
