<?php

class discount extends Logger {


    public function generaldiscount() {
        $this->engine = new engine();
        // for now only red discount, all other discount and managed here for simplicity
        return self::redwidget();
    }

    private function redwidget() {
        //get discount for red
        

        $quantity = 0;
        $price = 0;

        if ( $this->engine->get_session( 'cart' ) ) {
            $cart = $this->engine->get_session( 'cart' );
            foreach ( $cart AS $code ) {
                if ( $code == 'R01' ) {
                    $quantity++;
                    //get the price and total count of red
                    //and if price is gotten, no need to go through db again
                    if ( $price == 0 ) {
                        $row = $this->engine->db_query( 'SELECT price FROM product WHERE code = ? LIMIT 1', array( $code ) );

                        $price = $row[ 0 ][ 'price' ];
                    }
                }
            }

        }

        $discount = 0;
        if ( $quantity > 1 ) {
            $divide = $quantity/2;
            if ( $quantity%2 == 0 ) {

                //$whole = $divide;
                $reminder = $divide;
            } else {
                // $whole = round( $divide );
                $reminder = floor( $divide );
            }
            //$whole = ( $whole*$price ).'</br>';
            $discount = ( ( $reminder*$price )/2 );

        }

        return $discount;

    }



}
?>