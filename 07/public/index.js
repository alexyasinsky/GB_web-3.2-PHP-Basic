const addActionToBuyButton = async (button) => {
  let productId = button.dataset.product_id;
  let response = await fetch(`/basketapi`, {
    method: 'POST',
    body: productId
  });
};

