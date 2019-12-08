import React from "react";
import Container from "react-bootstrap/Container";
import Jumbotron from "react-bootstrap/Jumbotron";


export const Home = () => {
	return (
		<>
				<Container fluid="true">
					<Jumbotron className="py-10 m-5">
						<h1>Food Truck Foody</h1>
						<p>
							ABQ's Social Network for Food Trucks
						</p>
					</Jumbotron>
				</Container>
		</>
	)
};

