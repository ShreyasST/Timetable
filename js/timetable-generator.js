document.addEventListener('DOMContentLoaded', function() {
    initializeTimetable();
    initializeControls();
});

function initializeTimetable() {
    generateTimeSlots();
    populateTimetable();
}

function initializeControls() {
    document.getElementById('generateTimetable').addEventListener('click', generateNewTimetable);
    document.getElementById('exportTimetable').addEventListener('click', exportTimetable);
    document.getElementById('importTimetable').addEventListener('click', importTimetable);
}

function generateTimeSlots() {
    const tbody = document.querySelector('#timetableGrid tbody');
    const timeSlots = [
        '8:00 - 9:00',
        '9:00 - 10:00',
        '10:15 - 11:15',
        '11:15 - 12:15',
        '13:15 - 14:15',
        '14:15 - 15:15'
    ];
    
    tbody.innerHTML = timeSlots.map(time => `
        <tr>
            <td>${time}</td>
            ${Array(5).fill('<td class="timetable-cell" data-time="' + time + '"></td>').join('')}
        </tr>
    `).join('');
}

function populateTimetable() {
    // Add logic to populate timetable with existing data
}

function generateNewTimetable() {
    // Add timetable generation algorithm
    console.log('Generating new timetable...');
}

function exportTimetable() {
    // Add export functionality
    console.log('Exporting timetable...');
}

function importTimetable() {
    // Add import functionality
    console.log('Importing timetable...');
} 