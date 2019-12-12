import React from 'react';
import ReactDOM from 'react-dom'
import 'bootstrap/dist/css/bootstrap.css';
import {BrowserRouter} from "react-router-dom";
import {Route, Switch} from "react-router";
import {FourOhFour} from "./pages/FourOhFour";
import {Home} from "./pages/Home";
import {MainNav} from "./shared/components/main-nav/MainNav";
import {Footer} from "./shared/components/footer/footer";
import "./index.css";
import { library } from '@fortawesome/fontawesome-svg-core'
import {faDove, faEnvelope, faKey, faPhone, faStroopwafel} from '@fortawesome/free-solid-svg-icons'
import {Provider} from "react-redux";
import {applyMiddleware, createStore} from "redux";
import thunk from "redux-thunk";
import {combinedReducers} from "./shared/reducers/index";
// import 'bootstrap/dist/js/bootstrap.bundle.min';
import {UserPage} from "./pages/UserPage/UserPage";

const store = createStore(combinedReducers, applyMiddleware(thunk));

library.add(faStroopwafel, faEnvelope, faKey, faDove, faPhone);


const Routing = (store) => (
	<>
		<Provider store={store}>
		<BrowserRouter>
			<MainNav/>
			<Switch>
				<Route exact path="/" component={Home}/>
				<Route component={FourOhFour}/>
				<Route exact path="/UserPage" component={"/"} userId=":userId"/>
			</Switch>
			<Footer/>
		</BrowserRouter>
		</Provider>
	</>
);
ReactDOM.render(Routing(store), document.querySelector("#root"));