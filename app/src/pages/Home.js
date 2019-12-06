import React from "react";
import Container from "react-bootstrap/Container";
import Jumbotron from "react-bootstrap/Jumbotron";


export const Home = () => {
	return (
		<>
			<main className="d-flex align-items-center mh-80">
				<Container fluid="true">
					<Jumbotron>
						<h1>Fluid jumbotron</h1>
						<p>
							This is a modified jumbotron that occupies the entire horizontal space of
							its parent.
						</p>
					</Jumbotron>
				</Container>
			</main>
		</>
	)
};

