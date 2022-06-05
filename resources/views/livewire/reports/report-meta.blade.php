<div>
    <h3 class="text-white text-center text-3xl mb-4">Meta de Atividade - Últimos 7 dias</h3>

    <div class="flex gap-2 justify-center items-center mb-4">
        <label for="activity" class="text-white text-xl">Atividade:</label>
        <select id="activity" wire:model="activity_id">
            @foreach($activities as $activity)
            <option value="{{ $activity->id }}">{{ $activity->name }}</option>
            @endforeach
        </select>
    </div>

    <div class="flex justify-center">
        <canvas class="bg-white" id="myChart" width="600"  height="400"></canvas>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function(event) {
            const ctx = document.getElementById('myChart');
            const myChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    datasets: [{
                        label: 'Horas por Dia',
                        data: {!! $sessionsByDate !!},
                        backgroundColor: [
                            '#FF6384',
            
                        ],
                        borderWidth: 2,
                        order: 1
                    },
                    {
                        label: 'Meta',
                        data: {!! $meta !!},
                        type: 'line',
                        backgroundColor: [
                            '#FF0000',
                        ],
                        borderWidth: 4,
                        order: 0
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
            Livewire.on('chartChange',function(sessionsByDate,meta){
                myChart.data.datasets[0].data = sessionsByDate;
                myChart.data.datasets[1].data = meta;
                myChart.update();
            });
        });
    </script>
</div>
