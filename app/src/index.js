import React from 'react';
import ReactDOM from 'react-dom'
import 'bootstrap/dist/css/bootstrap.css';
import {BrowserRouter} from "react-router-dom";
import {Route, Switch} from "react-router";
import {FourOhFour} from "./pages/FourOhFour";
import {Home} from "./pages/Home";
// import {SignInForm} from "./shared/components/main-nav/sign-in/SignInForm";
import {MainNav} from "./shared/components/main-nav/MainNav";



const Routing = () => (
	<>
		<BrowserRouter>
			<Switch>
				 <MainNav/>
				<Route exact path="/" component={Home}/>
				<Route component={FourOhFour}/>
			</Switch>
		</BrowserRouter>
	</>
);
ReactDOM.render(<Routing/>, document.querySelector('#root'));