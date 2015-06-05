# MaskPHP

- Mask for display 

# Use

    <?php
        use Mask\Predefined\Br\Cep;

        class Foo 
        {

            ...

            public function setCep($cep)
            {
                return new Cep()->mask($cep);
            }

            ...
        }


