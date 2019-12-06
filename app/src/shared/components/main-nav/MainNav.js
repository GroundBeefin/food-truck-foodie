import React from "react";
import Navbar from "react-bootstrap/Navbar";
import Nav from "react-bootstrap/Nav";
import {LinkContainer} from "react-router-bootstrap"
import {SignUpModal} from "./sign-up/SignUpModal";
import {SignInModal} from "./sign-in/SignInModal";



export const MainNav = (props) => {
	return(
		<Navbar bg="primary" variant="dark">
			<LinkContainer exact to="/" >
				<Navbar.Brand>Food Truck Foodie</Navbar.Brand>
			</LinkContainer>
			<Nav className="m	r-auto">
				<SignUpModal/>
				<SignInModal/>
			</Nav>
		</Navbar>
	)
};