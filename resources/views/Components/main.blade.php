<div class="mt-16">
    <div class="grid grid-cols-5  mt-8 text-gray-700 font-bold py-3">
        <span class="col-span-2">عنوان وظیفه</span>
        <span>تاریخ پایان</span>
        <span>اولویت</span>
        <span class="text-center">وضعیت</span>
    </div>

    <div id="tasks-container"></div>

</div>

<script>
  
window.apiBaseUrl = "{{ env('API_BASE_URL') }}";

document.addEventListener('DOMContentLoaded', function() {
    function fetchTasks(){
        axios.get(apiBaseUrl + '/tasks')
        .then(function (response) {
            const tasks = response.data.data;
            const container = document.getElementById('tasks-container');
            
            container.innerHTML = '';

            tasks.forEach(task => {
                const taskHtml = `
                    <div class="grid grid-cols-5 px-3 py-6 mt-4 border rounded-lg">
                        <span class="col-span-2 cursor-pointer">${task.title}</span>
                        <span>${task.expiration_date}</span>
                        <span>${task.priority}</span>
                        <span class="text-center">${task.status}</span>
                    </div>
                `;
                container.innerHTML += taskHtml;
            });
        })
        .catch(function (error) {
            console.error(error);
        });
    }

    
    fetchTasks();

   
    Echo.channel('tasks')
        .listen('TaskCreated', function(event) {
            fetchTasks(); 
        });
});

</script>