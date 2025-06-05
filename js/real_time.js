function updateTime() {
    const now = new Date();
    const timeString = now.toLocaleTimeString(); // Format: HH:MM:SS AM/PM
    document.getElementById('live-time').textContent = timeString;
  }

  // Update the time every second
  setInterval(updateTime, 1000);

  // Set the initial time
  updateTime();