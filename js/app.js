Chart.defaults.color = '#000';
Chart.defaults.borderColor = '#444';

fetch('datos.json')
    .then(response => response.json())
    .then(data => processData(data))
    .catch(error => console.error('Error fetching data:', error));

const processData = (data) => {
    const formattedData = data.map(item => ({
      marca: item.Marca,
      categoria: item.Categoria,
      precio: parseFloat(item.Precio)
    }));
  
    const brands = formattedData.map(item => item.marca);
    const uniqueBrands = [...new Set(brands)];
    const brandCounts = uniqueBrands.map(brand => ({
      model: brand,
      count: brands.filter(item => item === brand).length
    }));
  
    const categories = formattedData.map(item => item.categoria);
    const uniqueCategories = [...new Set(categories)];
    const categoryCounts = uniqueCategories.map(category => ({
      feature: category,
      count: categories.filter(item => item === category).length
    }));
  
    const pricesByBrand = uniqueBrands.map(brand => ({
      model: brand,
      count: formattedData.filter(item => item.marca === brand)
        .reduce((total, item) => total + item.precio, 0)
    }));
  
    // Llamar a las funciones de renderizado con los nuevos datos
    renderModelsChart(brandCounts);
    renderFeaturesChart(categoryCounts);
    renderYearsChart(pricesByBrand);
  };

  const renderModelsChart = coasters => {
    const uniqueModels = coasters.map(coaster => coaster.model);
    const data = {
        labels: uniqueModels,
        datasets: [{
            label: 'Cantidad por Marca',
            data: coasters.map(coaster => coaster.count),
            backgroundColor: getDataColors(20),
            borderColor: getDataColors(),
            borderWidth: 5
        }]
    };
    const options = {
        plugins: {
            legend: { position: 'top' }
        }
    };
    new Chart('modelsChart', { type: 'bar', data, options });
};

const renderFeaturesChart = coasters => {
    const uniqueCategories = coasters.map(coaster => coaster.feature);
    const data = {
        labels: uniqueCategories,
        datasets: [{
            label: 'Cantidad de pares',
            data: coasters.map(coaster => coaster.count),
            backgroundColor: getDataColors(20),
            borderColor: getDataColors(),
            borderWidth: 5
        }]
    };
    const options = {
        plugins: {
            legend: { position: 'top' }
        },
        scales: {
            y: {
                beginAtZero: true
            }
        }
    };
    new Chart('featuresChart', { type: 'bar', data, options });
};

const renderYearsChart = coasters => {
    const uniqueBrands = coasters.map(coaster => coaster.model);
    const data = {
        labels: uniqueBrands,
        datasets: [{
            label: 'Suma de costos por Marca',
            data: coasters.map(coaster => coaster.count),
            backgroundColor: getDataColors(20),
            borderColor: getDataColors(),
            borderWidth: 5
        }]
    };
    const options = {
        plugins: {
            legend: { position: 'top' }
        },
        scales: {
            y: {
                beginAtZero: true
            }
        }
    };
    new Chart('yearsChart', { type: 'bar', data, options });
};

printCharts();