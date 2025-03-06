

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


  const userData = localStorage.getItem('user');
  if (!userData) {
    warningAlert("User not logged in");
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

    const wallets = result.wallets;

    const walletSelect = document.getElementById('walletSelect');
    walletSelect.innerHTML = ''; 
  
    wallets.forEach(wallet => {
      const option = document.createElement('option');
      option.value = wallet.wallet_id;         
      option.textContent = wallet.wallet_name;  
      walletSelect.appendChild(option);
    });


    const walletIds = wallets.map(wallet => wallet.wallet_id);
  localStorage.setItem('walletIds', JSON.stringify(walletIds));

    if (wallets.length > 0) {
      walletSelect.value = wallets[0].wallet_id; 
      document.getElementById('wallet-id').textContent = '#' + wallets[0].wallet_id;
      document.getElementById('wallet-balance').textContent = `Your Current balance is: ${wallets[0].balance}$`;
    }
  
  
};


walletPages.load_updateWalletDetails = async () => {
  walletPages.wallet = {};
  walletPages.wallet.wallet_details_api = walletPages.base_api + "getWalletById.php";

  walletSelect.addEventListener('change', async (event) => {
    const selectedWalletId = event.target.value;

    const formData = new FormData();
    formData.append("wallet_id", selectedWalletId);
  
    try {
      const result = await walletPages.post_data(walletPages.wallet.wallet_details_api, formData, {
        headers: {
          "Content-Type": "application/x-www-form-urlencoded"
        }
      });
  
      if (result && result.wallet) {
        document.getElementById('wallet-id').textContent = '#' + result.wallet.wallet_id;
        document.getElementById('wallet-balance').textContent = `Your Current balance is: ${result.wallet.balance}$`;
      } else if (result && result.error) {
        alert(result.error);
      }
    } catch (error) {
      console.error("Error fetching wallet details:", error);
    }
   
  });


};


walletPages.load_createWallet = async () => {
  walletPages.createWallet = {};
  walletPages.createWallet.createWallet_api = walletPages.base_api + "createWallet.php";

  const contactForm = document.getElementById("create-wallet");

  contactForm.addEventListener("submit", async (event) => {
    event.preventDefault();
    const walletName = document.getElementById("wallet-name").value;
    const walletAmount = document.getElementById("wallet-amount").value;

    const userData = localStorage.getItem('user');
    if (!userData) return;
    
    const user = JSON.parse(userData);

    const user_id = user.id;

    try {
      const formData = new FormData();
      formData.append('wallet-name', walletName);
      formData.append('balance', walletAmount);
      formData.append('user_id', user_id);

      const result = await walletPages.post_data(walletPages.createWallet.createWallet_api, formData, {
        // headers: {
        //   "Content-Type": "application/x-www-form-urlencoded" 
        // }
      });

      if(result.success == 1) {
        console.log("success happens")
        successAlert(result.message);
      } else if(result.success == -1){
        console.log("error happens"),
        console.log(result.message),
        console.log(result),
        warningAlert (result.message);
      }else {
        errorAlert (result.message);
      }

    } catch (error) {
      console.log(error)
    }
  })
}


walletPages.load_deposit = () => {
  walletPages.deposit = {};
  walletPages.deposit.deposit_api = walletPages.base_api + "deposit.php";

  const depositButton = document.getElementById('deposite-btn');

  depositButton.addEventListener('click', async () => {
    const amountInput = document.getElementById('amount');
    const amount = parseFloat(amountInput.value);
    
    if (isNaN(amount) || amount <= 0) {
      warningAlert("Please enter a valid deposit amount.");
      return;
    }

    const walletSelect = document.getElementById('walletSelect');
    const selectedWalletId = walletSelect.value;
    const userData = localStorage.getItem('user');
    if (!userData) return;
    
    const user = JSON.parse(userData);
    const user_id = user.id;

    if (!selectedWalletId) {
      warningAlert("Please select a wallet.");
      return;
    }

    const formData = new FormData();
    formData.append("wallet_id", selectedWalletId);
    formData.append("amount", amount);
    formData.append('user_id', user_id);

    try {
      const result = await walletPages.post_data(
        walletPages.deposit.deposit_api, 
        formData, 
        { headers: { "Content-Type": "application/x-www-form-urlencoded" } }
      );

      if (result?.success) {
        successAlert("Deposit successful!");
        amountInput.value = '';
        
        
      } else if (result?.error || result?.message) {
        errorAlert(result.error || result.message);
      } else {
        errorAlert("Deposit failed. Please try again.");
      }
    } catch (error) {
      console.error("Deposit error:", error);
      errorAlert("Error processing deposit. Please try again.");
    }
  });
};

walletPages.load_transfer = () => {
  walletPages.transfer = {};
  walletPages.transfer.transfer_api = walletPages.base_api + "transfer";
}


walletPages.load_contactAdmin = async () => {
  walletPages.contact = {};
  walletPages.contact.contact_api = walletPages.base_api + "contactAdmin.php";

  const contactForm = document.getElementById("contact-form");

  contactForm.addEventListener("submit", async (event) => {
    event.preventDefault();
    const emailValue = document.getElementById("email").value;
    const messaageValue = document.getElementById("message").value;

    try {
      const formData = new FormData();
      formData.append('email', emailValue);
      formData.append('message', messaageValue);

      const result = await walletPages.post_data(walletPages.contact.contact_api, formData, {
        headers: {
          "Content-Type": "application/x-www-form-urlencoded" 
        }
      });

      if(result.success) {
        console.log("success happens")
        successAlert(result.message);
      } else {
        console.log("error happens"),
        console.log(result.message),
        console.log(result),
        errorAlert (result.message);
      }

    } catch (error) {
      
    }
  })
}



const logout = () => {
  localStorage.removeItem("user"); 
  localStorage.removeItem("walletIds"); 
  window.location.href = "login.html"; 
}





