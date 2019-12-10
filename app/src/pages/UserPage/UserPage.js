import React, {useEffect} from "react";
import {useSelector, useDispatch} from "react-redux";
import {UseJwtUserId} from "../../shared/misc/JwtHelpers";

import Container from "react-bootstrap/Container";
import Row from "react-bootstrap/Row";
import Col from "react-bootstrap/Col";
import Card from "react-bootstrap/Card";
import Form from "react-bootstrap/Form";
import InputGroup from "react-bootstrap/InputGroup";
import FormControl from "react-bootstrap/es/FormControl";
import Button from "react-bootstrap/Button";
import {getAllUsers, getUserByUserId} from "../../shared/actions/get-user";
import {Route} from "react-router";


export const UserPage = ({match}) => {

	// Return the user by userId from the redux store
	const user = useSelector(state => (state.user ? state.user[0] : []));
	console.log(user);

	const currentUserId = UseJwtUserId();

	// Returns the userPage store from redux and assigns it to the userPage variable.
	// const user = useSelector(state => state.user ? state.user : []);

	// grab the user id from the currently logged in account, or null if not found

	const dispatch = useDispatch();

	const sideEffects = () => {

		// The dispatch function takes actions as arguments to make changes to the store/redux.
		dispatch(getAllUsers(match.params.userId))
	};


	// Declare any inputs that will be used by functions that are declared in sideEffects.
	const sideEffectInputs = [match.params.userId];

	// const effects = () => {
	// 	dispatch(getUserByUserId(match.params.userId));
	// };

	// const inputs = [match.params.userId];
	// useEffect(effects, inputs);

	/**
	 * Pass both sideEffects and sideEffectInputs to useEffect.
	 * useEffect is what handles rerendering of components when sideEffects resolve.
	 * E.g when a network request to an api has completed and there is new data to display on the dom.
	 **/
	useEffect(sideEffects, sideEffectInputs);


	return (
		<>

			{/*the Route component wraps around the UserListComponent to give it access to the history prop inside of Route*/}
			<Route render={({history}) => (

						<main className="mh-100 d-flex align-items-center">
							onclick={() => {
								history.push('{user/${user.userId}')
						}}>
							<Container fluid="true" className="py-5">
								<Row>
									<Col md="8">
										<Card bg="light">
											<Card.Header>
												<h2 className="my-0">Hello, {user && user.UserName}!</h2>
											</Card.Header>
											<Card.Body>
												<div>UserName: {user && user.userName}</div>

												{/* only show the private user data if logged into the same account! */}
												{(user && user.userId === currentUserId) && (
													<>
														<div>Your User Id: {UserPage && user.userId}</div>
														<div>Your Email Address: {user && user.userEmail}</div>
														<div>Your Activation Token: {(user) && user.userActivationToken}</div>
													</>

												)}

											</Card.Body>
										</Card>
									</Col>
								</Row>
							</Container>
						</main>
				)}
					 />
		</>
	)
};