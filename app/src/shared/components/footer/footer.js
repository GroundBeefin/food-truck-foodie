import React, {useEffect} from "react";
import {Link, Route} from "react-router-dom";
import Container from "react-bootstrap/Container";
import Row from "react-bootstrap/Row";
import Col from "react-bootstrap/Col";

import {FontAwesomeIcon} from "@fortawesome/react-fontawesome";



export const Footer = () => (
	<>
				<div className="fixed-bottom">
					<footer className="page-footer text-muted py-2 py-md-4">
						<Container fluid="true">
							<Row>
												<Col className="text-center">
															<FontAwesomeIcon icon={['fab', 'github']} /> &nbsp;

															<a href="https://github.com/GroundBeefin/FoodTruckFoodie" className="text-muted" target="_blank" rel="noopener noreferrer">GitHub</a>

												</Col>
										</Row>
							</Container>

					</footer>
				</div>
			</>
);