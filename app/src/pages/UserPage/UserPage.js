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
import {getUserByUserId} from "../../shared/actions/get-user";

export const User = ({match}) => {

	// grab the user id from the currently logged in account, or null if not found
	const currentUserId = UseJwtUserId();

	// Return the user by userId from the redux store
	//TODO: fix this. Prob grabbing user[0] from users loaded in User! Match the currentUserId to find/match user by userId on the users already in redux store?
	const user = useSelector(state => (state.user ? state.user[0] : []));
	console.log(user);

	const dispatch = useDispatch();

	const effects = () => {
		dispatch(getUserByUserId(match.params.userId));
	};

	const inputs = [match.params.userId];
	useEffect(effects, inputs);

	return (
		<>
			<main className="mh-100 d-flex align-items-center">
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
											<div>Your User Id: {User && user.userId}</div>
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
		</>
	)
};