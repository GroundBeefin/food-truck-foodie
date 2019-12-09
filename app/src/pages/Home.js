import React from "react";
import Jumbotron from "react-bootstrap/Jumbotron";
import MainFTFlogo3 from "../images/MainFTFLogo3.png";
import Image from "react-bootstrap/Image";


export const Home = () => {
	return (
		<>
			<container-fluid>
				<Jumbotron>
					<div className="d-flex justify-content-center">
						<Image src={MainFTFlogo3} alt="logo"/>
					</div>
				</Jumbotron>
			</container-fluid>
		</>
	)
};
