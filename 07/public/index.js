const addPostQueryToElement = async (url, data) => {
    let response = await fetch(url, {
      method: 'POST',
      headers: new Headers({
        'Content-Type': 'application/json'
      }),
      body: JSON.stringify(data),
    });
    // return await response.json();
};

