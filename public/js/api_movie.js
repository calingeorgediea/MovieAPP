const options_id = {
	method: 'GET',
	headers: {
		'X-RapidAPI-Key': '428ee192aamshb1dd564fa60d9adp128458jsnd5ce70f03f63',
		'X-RapidAPI-Host': 'imdb8.p.rapidapi.com'
	}
};

fetch('https://imdb8.p.rapidapi.com/title/v2/find?title=one%20flew%20over&limit=1&sortArg=moviemeter%2Casc', options_id)
	.then(response => response.json())
	.then(response => console.log(response))
	.catch(err => console.error(err));

const options = {
	method: 'GET',
	headers: {
		'X-RapidAPI-Key': '428ee192aamshb1dd564fa60d9adp128458jsnd5ce70f03f63',
		'X-RapidAPI-Host': 'imdb8.p.rapidapi.com'
	}
};

fetch('https://imdb8.p.rapidapi.com/title/get-overview-details?tconst=tt0073486&currentCountry=US', options)
	.then(response => response.json())
	.then(response => console.log(response))
	.catch(err => console.error(err));