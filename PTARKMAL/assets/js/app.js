function makeChart(canvasId, type, labels, values, label) {
    const canvas = document.getElementById(canvasId);
    if (!canvas) return;
    new Chart(canvas, {
        type,
        data: {
            labels,
            datasets: [{ label, data: values, borderWidth: 1 }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: { legend: { position: 'bottom' } },
            scales: type === 'bar' || type === 'line' ? { y: { beginAtZero: true, ticks: { precision: 0 } } } : {}
        }
    });
}
