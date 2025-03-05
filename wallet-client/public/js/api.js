

const walletPages = {};

walletPages.base_api = "http://localhost/wallet-project/wallet-server/user/v1/"

walletPages.get_data = async (url) => {
  try {
    const response = await axios.get(url);
    return response.data
  } catch(error) {
    console.log(error);
  }

}

walletPages.post_data = async (url, data) => {
  try {
    const response = await axios.post(url, data);
    return response.data;
  } catch (error) {
    console.log(error);
  }
}


walletPages.loadFor = (page_name) => {
  eval(`walletPages.load_${page_name}();`);
}


walletPages.load_login = async () => {
  walletPages.login = {};
  walletPages.login.login_api = walletPages.base_api + "login.php";

  const loginForm = document.getElementById("loginForm");

  loginForm.addEventListener("submit", async (event) => {
    event.preventDefault();
    const emailValue = document.getElementById('email').value;
    const passwordValue = document.getElementById('password').value;

    try {
      const formData = new FormData();
      formData.append('email', emailValue);
      formData.append('password', passwordValue);


      const result = await walletPages.post_data(
        walletPages.login.login_api,
        formData,
        {
          headers: {
            "Content-Type": "application/x-www-form-urlencoded" 
          }
        }
      );
      console.log(result)

      if (result && result.user) {
        console.log("User object:", result.user);
        localStorage.setItem('user', JSON.stringify(result.user));
        window.location.href = "dashboard.html";
      } else {
        alert(result?.message || "Login failed");
      } 
    } catch (error) {
      console.error("Login error:", error);
      alert("An error occurred during login");
    }
  });
};

walletPages.load_signUp = () => {
  walletPages.signUp = {};
  walletPages.signUp.signUp_api = walletPages.base_api + "registration.php";

  const registerForm = document.getElementById("registerForm");

  registerForm.addEventListener("submit", async (event) => {
    event.preventDefault();
    const emailValue = document.getElementById('reg-email').value;
    const passwordValue = document.getElementById('reg-password').value;
    const firstNameValue = document.getElementById('first-name').value;
    const lastNameValue = document.getElementById('last-name').value;

    try {
      const formData = new FormData();
      formData.append('email', emailValue);
      formData.append('password', passwordValue);
      formData.append('first_name', firstNameValue);
      formData.append('last_name', lastNameValue);


      const result = await walletPages.post_data(
        walletPages.signUp.signUp_api,
        formData,
        {
          headers: {
            "Content-Type": "application/x-www-form-urlencoded" 
          }
        }
      );
      console.log(result)

      // if (result && result.user) {
      //   console.log("User object:", result.user);
      //   localStorage.setItem('user', JSON.stringify(result.user));
         window.location.href = "dashboard.html";
      // } else {
      //   alert(result?.message || "Login failed");
      // } 
    } catch (error) {
      console.error("Login error:", error);
      alert("An error occurred during login");
    }
  });
}

walletPages.load_dashboard = () => {
  walletPages.dashboard = {};
  walletPages.dashboard.dashboard_api = walletPages.base_api + "dashboard";
}


walletPages.load_profile = () => {
  walletPages.profile = {};
  
  // alert("profile loaded");
  const userData = localStorage.getItem('user');
  if (!userData) return;
  
  const user = JSON.parse(userData);
  
  const fullNameInput = document.getElementById("fullName");
  const emailInput = document.getElementById("email");
  const phoneInput = document.getElementById("phone");
  const addressInput = document.getElementById("address");
  // const phoneVerificationInput = document.getElementById("phone-number");
  
  if (fullNameInput) fullNameInput.value = user.first_name + " " + user.last_name || "";
  if (emailInput) emailInput.value = user.email || "";
  if (phoneInput) phoneInput.value = user.phone || "";
  if (addressInput) addressInput.value = user.address || "";
  if (phoneVerificationInput) phoneVerificationInput.value = user.phone || "";
};



walletPages.load_wallets = async () => {
  walletPages.wallet = {};
  walletPages.wallet.wallet_api = walletPages.base_api + "getWallets.php";

  walletPages.wallet.displayWallets = (wallets) => {
    const container = document.getElementById("walletsContainer");
    if (!container) {
      console.error("Wallets container not found");
      return;
    }
    container.innerHTML = ""; 
    wallets.forEach(wallet => {
      const walletItem = document.createElement("div");
      walletItem.classList.add("wallet-item");
      walletItem.innerHTML = `
        <h3>Wallet ID: ${wallet.wallet_id}</h3>
        <p>Name: ${wallet.wallet_name || 'N/A'}</p>
        <p>Balance: ${wallet.balance || 0}</p>
      `;
      container.appendChild(walletItem);
    });
  };

  const userData = localStorage.getItem('user');
  if (!userData) {
    alert("User not logged in");
    return;
  }
  const user = JSON.parse(userData);
  const userId = user.id;
  console.log("User ID:", userId);

  const formData = new FormData();
  formData.append("user_id", userId);

  const result = await walletPages.post_data(walletPages.wallet.wallet_api, formData, {
    headers: {
      "Content-Type": "application/x-www-form-urlencoded"
    }
  });
  console.log("Wallet API response:", result);

  if (result && result.wallets) {
    walletPages.wallet.displayWallets(result.wallets);
  } else if (result && result.error) {
    alert(result.error);
  } else {
    alert("No wallets found.");
  }
};


walletPages.load_createWallet = () => {
  walletPages.transfer = {};
  walletPages.transfer.transfer_api = walletPages.base_api + "createWallet.php";

  

}

walletPages.load_transfer = () => {
  walletPages.transfer = {};
  walletPages.transfer.transfer_api = walletPages.base_api + "transfer";
}

