

const walletPages = {};

walletPages.base_api = "http://localhost/wallet-project/wallet-server/user/v1/";

const alertContainer = document.getElementById('alert-container')
const successAlert = (message) => {
  const alert = `
      <div class="alert success">
          <i>
              <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-check">
                  <path d="M20 6 9 17l-5-5"/>
              </svg>
          </i>
          <strong>Success!</strong> ${message}
      </div>
  `;
  alertContainer.innerHTML += alert;

  setTimeout(() => {
    const alertElement = document.querySelector('.alert.success');
    if (alertElement) {
        alertElement.remove();
    }
}, 2000);
};

const warningAlert = (message) => {
  const alert = `
      <div class="alert warning">
          <i>
              <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-triangle-alert">
                  <path d="m21.73 18-8-14a2 2 0 0 0-3.48 0l-8 14A2 2 0 0 0 4 21h16a2 2 0 0 0 1.73-3"/>
                  <path d="M12 9v4"/>
                  <path d="M12 17h.01"/>
              </svg>
          </i>
          <strong>Warning!</strong> ${message}
      </div>
  `;
  alertContainer.innerHTML += alert;

  setTimeout(() => {
    const alertElement = document.querySelector('.alert.warning');
    if (alertElement) {
        alertElement.remove();
    }
}, 2000);
};

const errorAlert = (message) => {
  const alert = `
      <div class="alert error">
          <i>
              <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-circle-x">
                  <circle cx="12" cy="12" r="10"/>
                  <path d="m15 9-6 6"/>
                  <path d="m9 9 6 6"/>
              </svg>
          </i>
          <strong>Error!</strong> ${message}
      </div>
  `;
  alertContainer.innerHTML += alert;

  setTimeout(() => {
    const alertElement = document.querySelector('.alert.error');
    if (alertElement) {
        alertElement.remove();
    }
}, 2000);
};



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
        successAlert(result.message);
        localStorage.setItem('user', JSON.stringify(result.user));
        window.location.href = "dashboard.html";
      } else {
        errorAlert(result?.message || "Login failed")
        // alert(result?.message );
      } 
    } catch (error) {
      console.error("Login error:", error);
      // alert();
      errorAlert("An error occurred during login")
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
      errorAlert("An error occurred during signUp")
      
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

