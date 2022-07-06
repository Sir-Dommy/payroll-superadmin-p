class rating extends HTMLElement {
    constructor() {
      super();
    }

 connectedCallback(){
        this.innerHTML =`
            <span class="fa fa-star checked"></span>
            <span class="fa fa-star checked"></span>
            <span class="fa fa-star checked"></span>
            <span class="fa fa-star checked"></span>
            <span class="fa fa-star checked"></span>`
    }
}
customElements.define('app-rating', rating);

// Dan's html code
class footer extends HTMLElement {
    constructor() {
      super();
    }

 connectedCallback(){
        this.innerHTML =`
        <footer>
        <div class="content">
          <div class="left box">
            <div class="upper">
              <div class="topic">About us</div>
              <p>Kusoma is a platform where you can learn HTML,
              CSS, and also JavaScript along with creative CSS Animations and Effects.</p>
            </div>
            <div class="lower">
              <div class="topic">Contact us</div>
              <div class="phone">
                <a href="#"><i class="fas fa-phone-volume"></i>0708646784</a>
              </div>
              <div class="email">
                <a href="#"><i class="fas fa-envelope"></i>tusome@gmail.com</a>
              </div>
            </div>
          </div>
          <div class="middle box">
            <div class="topic">Our Services</div>
            <div><a href="#">Web Design, Development</a></div>
            <div><a href="#">Web UX Design, Reasearch</a></div>
            <div><a href="#">Web User Interface Design</a></div>
            <div><a href="#">Theme Development, Design</a></div>
            <div><a href="#">Mobile Application Design</a></div>
            <div><a href="#">Wire raming & Prototyping</a></div>
          </div>
          <div class="right box">
            <div class="topic">Subscribe us</div>
            <form action="#">
              <input type="text" placeholder="Enter email address">
              <input type="submit" name="" value="Send">
              <div class="media-icons">
                <a href="#"><i class="fab fa-facebook-f"></i></a>
                <a href="#"><i class="fab fa-instagram"></i></a>
                <a href="#"><i class="fab fa-twitter"></i></a>
                <a href="#"><i class="fab fa-youtube"></i></a>
                <a href="#"><i class="fab fa-linkedin-in"></i></a>
              </div>
            </form>
          </div>
        </div>
        <div class="bottom">
          <p>Copyright © 2020 <a href="#">Kusoma Portal</a> All rights reserved</p>
        </div>
      </footer>`
    }
}
customElements.define('app-footer', footer);

// Mercy design begins
class mercy extends HTMLElement {
    constructor() {
      super();
    }

 connectedCallback(){
        this.innerHTML =`
        <section id="Education">
        <div class="container">
            <h1 class="headings">Featured topics by category</h1>
            <div class="dropdown">
                <button class="dropbtn">Education</button>
                <div class="dropdown-content">
                    <a href="Education">CBC</a>
                    <a href="#">844</a>
                    <a href="#">Computer Science </a>
                    <a href="#">Commerce</a>
                    <a href="#">Literature</a>
        
                </div>
            </div>
            <div class="dropdown">
                <button class="dropbtn">Finance</button>
                <div class="dropdown-content">
                    <a href="#">Personal Finance</a>
                    <a href="#">Accountacy</a>
                    <a href="#">Ecommerce  </a>
                    <a href="#">Entrepreneurship</a>
                    <a href="#">Tax</a>
            
                </div>
            </div>
            <div class="dropdown">
                <button class="dropbtn">Fashion</button>
                <div class="dropdown-content">
                    <a href="#">Scents</a>
                    <a href="#">Body Types</a>
                    <a href="#">Jewelry </a>
                    <a href="#">clothes and shoes</a>
                    <a href="#">Makeup</a>
            
                </div>
            </div>
            <div class="dropdown">
                <button class="dropbtn">IT</button>
                <div class="dropdown-content">
                    <a href="#">Programming</a>
                    <a href="#">Cloud Computing</a>
                    <a href="#">Design </a>
                    <a href="#">Cyber Security</a>
                    <a href="#">Ethical hacking</a>
            
                </div>
            </div>
            <div class="button">
            <a href="index.html" style="color: white;">Explore More Categories</a>
    
            </div>
    
        </div>
    
    
    </section>
    
    <section id="About">
        <div class="container2">
        <div class="headings2"> <h1 class="headings">Become an instructor</h1></div>
        <div id="pic">
            <div class="pic1">        <img src="insructor.jpg" alt=""></div>
            <div id="intro">
                 <P>Instructors from around the world teach millions of students on kusoma.
                    we provide a platform and tools for you to teach what you love.
    
                    
                </P>
                <div class="joinUs"><a href="index.html"  style="color:black;background-color: #04AA6D;font-size: 16px;
                width: 90px;margin-left: 90px;padding: 15px 50px;margin-top: 70px;"class="btn">Join Us</a></div>
                
        
            </div>
            
         </div>
    
        </div>
    
    </section>`
    }
}
customElements.define('app-mercy', mercy);

// Eddah html design component

class eddah extends HTMLElement {
  constructor() {
    super();
  }

connectedCallback(){
      this.innerHTML =`
      <div class="overall-box">
      <h1>Top Categories</h1>
      <div class="grid-container ">
          <div class="grid-item">
              <img src="education.png" alt="education icon" width="30" height="30">
              <h4>education</h4>
          </div>
          <div class="grid-item">
              <img src="photograpy.png" alt="photograpy icon" width="30" height="30">
              <h4>photograpy</h4> 
          </div>
          <div class="grid-item">
              <img src="IT.png" alt="IT icon" width="30" height="30" >
              <h4>IT</h4>
          </div>
          <div class="grid-item">
              <img src="farming.png" alt="farming icon" width="30" height="30">
              <h4>farming</h4>

          </div>
          <div class="grid-item">
              <img src="fashion.png" alt="fashion icon" width="30" height="30">
              <h4>fashion</h4></div>
          <div class="grid-item">
              <img src="finance.png" alt="finance icon" width="30" height="30">
              <h4>finance</h4>
          </div>
      </div>
  </div>`
  }
}
customElements.define('app-eddah', eddah);

// Davi html design component
class davi extends HTMLElement {
  constructor() {
    super();
  }

connectedCallback(){
      this.innerHTML =`
      <div class="header">
       
      <div class="logo">
          <img src="Davi/helomobile.png" alt="helomobile logo" width="50px" height="50px">
          <!-- <p>perfect skills</p> -->
      </div>

      <ul>
          <li><a href="">Home</a></li>
          <li><a href="">About</a></li>
          <li class="categories"><a href="">categories</a>
              <div class="dropdown1">
                  <ul>
                      <li class="hover_me1"><a href="">link</a>
                          <div class="dropdown2">
                              <ul>
                                  <li class="hover_me2"><a href="">link1</a>
                                      <div class="dropdown3">
                                          <ul>
                                              <li><a href="">link1</a></li>
                                              <li><a href="">link1</a></li>
                                              <li><a href="">link1</a></li>
                                              <li><a href="">link1</a></li>
                                          </ul>
                                      </div>
                                  </li>
                                  <li class="hover_me2"><a href="">link1</a>
                                      <div class="dropdown3">
                                          <ul>
                                              <li><a href="">link1</a></li>
                                              <li><a href="">link1</a></li>
                                              <li><a href="">link1</a></li>
                                              <li><a href="">link1</a></li>
                                          </ul>
                                      </div>
                                  </li>
                                  <li class="hover_me2"><a href="">link1</a>
                                      <div class="dropdown3">
                                          <ul>
                                              <li><a href="">link1</a></li>
                                              <li><a href="">link1</a></li>
                                              <li><a href="">link1</a></li>
                                              <li><a href="">link1</a></li>
                                          </ul>
                                      </div>
                                  </li>
                                  <li  class="hover_me2"><a href="">link1</a>
                                      <div class="dropdown3">
                                          <ul>
                                              <li><a href="">link1</a></li>
                                              <li><a href="">link1</a></li>
                                              <li><a href="">link1</a></li>
                                              <li><a href="">link1</a></li>
                                          </ul>
                                      </div>
                                  </li>
                              </ul>
                          </div>
                      </li>
                      <li class="hover_me1"><a href="">link</a>
                          <div class="dropdown2">
                              <ul>
                                  <li><a href="">link1</a></li>
                                  <li><a href="">link1</a></li>
                                  <li><a href="">link1</a></li>
                                  <li><a href="">link1</a></li>
                              </ul>
                          </div>
                      </li>
                      <li class="hover_me1"><a href="">link</a>
                          <div class="dropdown2">
                              <ul>
                                  <li><a href="">link1</a></li>
                                  <li><a href="">link1</a></li>
                                  <li><a href="">link1</a></li>
                                  <li><a href="">link1</a></li>
                              </ul>
                          </div> 
                      </li>
                      <li class="hover_me1"><a href="">link</a>
                          <div class="dropdown2">
                              <ul>
                                  <li><a href="">link1</a></li>
                                  <li><a href="">link1</a></li>
                                  <li><a href="">link1</a></li>
                                  <li><a href="">link1</a></li>
                              </ul>
                          </div>  
                      </li>
                  </ul>
              </div>
          </li>
          <li><a href="">Teach</a></li>
      </ul>

  
          <div class="cart">
              <img src="Davi/cart.png" alt="cart" width="50px" height="50px">
              <p>cart</p>
          </div>
     
  </div>`
  }
}
customElements.define('app-davi', davi);