<div>
    <h3 class="text-white text-center text-3xl mb-4">Número de Horas por Atividade</h3>
    <div class="text-white text-2xl flex justify-center gap-4 py-4">
        <label for="all">
            <input type="radio" id="all" name="period" wire:model="period" value="all">
            <span>Todos</span>
        </label>
        <label for="week">
            <input type="radio" id="week" name="period" wire:model="period" value="week">
            <span>Últimos 7 dias</span>
        </label>
        <label for="month">
            <input type="radio" id="month" name="period" wire:model="period" value="month">
            <span>Últimos 30 dias</span>
        </label>
    </div>


    <div class="flex justify-center">
        <canvas class="bg-white" id="myChart" width="600"  height="400"></canvas>
    </div>

    <script defer>
        document.addEventListener("DOMContentLoaded", function(event) {
            const ctx = document.getElementById('myChart');
            const myChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    datasets: [{
                        label: 'Valor de Horas',
                        data: {!! $activitiesPerValue !!},
                        backgroundColor: [
                            '#FF6384',
                            '#36A2EB',
                            '#FFCE56',
                        ],
                        borderWidth: 2
                    }]
                },
                options: {
                    responsive: false,
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    },
                    plugins: {
                title: {
                    display: true,
                    text: 'Valor de Horas por Atividade'
                }
            }
                }
            });
            Livewire.on('chartChange',function(activitiesPerValue){
                myChart.data.datasets[0].data = activitiesPerValue; ;
                myChart.update();
            });
        });

        
</script>
</div>
