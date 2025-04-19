<!DOCTYPE html>
<html>
<head>
    <title>Broadcast Test</title>
    @vite('resources/js/app.js')
     <style>
        table {
            border-collapse: collapse;
            width: 60%;
        }
        th, td {
            border: 1px solid #ccc;
            padding: 8px;
        }
    </style>
</head>
<body>
    <h1>Broadcasted Message:</h1>
    <h2>Live Tag ID & Location Table</h2>
        <table id="tagTable">
            <thead>
                <tr>
                    <th>Tag ID</th>
                    <th>Location</th>
                </tr>
            </thead>
            <tbody id="tagTableBody">
                <tr><td colspan="2">Waiting for tags...</td></tr>
            </tbody>
        </table>


    <script>

    document.addEventListener("DOMContentLoaded", function () {
        const channel = window.Echo.channel('iot-data');

        channel.listen('MessageEvent', (event) => {
            const data = JSON.parse(event.message); 
                 console.log(data);
                const tagId = data.tag_id;
                const location = data.location;


            console.log(`Tag: ${tagId}, Location: ${location}`);

            const tableBody = document.getElementById('tagTableBody');

            // Remove "waiting for data" row if present
            const waitingRow = document.querySelector('#tagTableBody tr td[colspan="2"]');
            if (waitingRow) waitingRow.parentElement.remove();

            // Check if tagId already exists in the table
            const existingRow = document.querySelector(`#tagTableBody tr[data-tag-id="${tagId}"]`);
            if (existingRow) {
                // Update the location
                existingRow.querySelector('td.location').innerText = location;
            } else {
                // Add new row
                const newRow = document.createElement('tr');
                newRow.setAttribute('data-tag-id', tagId);
                newRow.innerHTML = `
                    <td>${tagId}</td>
                    <td class="location">${location}</td>
                `;
                tableBody.appendChild(newRow);
            }
        });
    });
</script>

<script>
// document.addEventListener("DOMContentLoaded", function () {
//    window.Echo.channel('iot-data')
//     .listen('MessageEvent', (event) => {
     
//       const tagId = event.message.tag_id;
//       const location = event.message.location;
//         console.log(`Tag: ${tagId}, Location: ${location}`);
//     });

//      });


//    document.addEventListener("DOMContentLoaded", function () {
//         const channel = window.Echo.channel('iot-data');
      
//         channel.listen('MessageEvent', (event) => {

//         const tagId = event.message.tag_id;
//         const location = event.message.location;
//         console.log(`Tag: ${tagId}, Location: ${location}`);

//         // Remove "Waiting for data" row if present
//         const waitingRow = document.querySelector('#tagTableBody tr td[colspan="2"]');
//         if (waitingRow) waitingRow.parentElement.remove();

//         // Create new row every time (no update logic)
//         const newRow = document.createElement('tr');
//             newRow.innerHTML = `
//                 <td>${tagId}</td>
//                 <td>${location}</td>
//             `;
//             document.getElementById('tagTableBody').appendChild(newRow);

//             // Optional: scroll to latest
//             newRow.scrollIntoView({ behavior: "smooth" });
//     });
// });



    // document.addEventListener("DOMContentLoaded", function () {
    //     const channel = window.Echo.channel('iot-data');

    //     channel.listen('MessageEvent', (event) => {
    //         const tagId = event.message.tag_id;
    //         const location = event.message.location;

    //         console.log(`Tag: ${tagId}, Location: ${location}`);

    //         // Remove "Waiting for data" row if present
    //         const waitingRow = document.querySelector('#tagTableBody tr td[colspan="2"]');
    //         if (waitingRow) waitingRow.parentElement.remove();

    //         // Create new row every time (no update logic)
    //         const newRow = document.createElement('tr');
    //         newRow.innerHTML = `
    //             <td>${tagId}</td>
    //             <td>${location}</td>
    //         `;
    //         document.getElementById('tagTableBody').appendChild(newRow);

    //         // Optional: scroll to latest
    //         newRow.scrollIntoView({ behavior: "smooth" });
    //     });
    // });

</script>

</body>
</html>
