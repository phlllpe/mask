# MaskPHP

- Mask for display 

# Use

    <?php
        use Mask\Predefined\Br\Cep;
        use Mask\Predefined\Br\Cpf;

        ...

        public function foo($cepValue)
        {
            ...
            $maskCep = new Cep()->mask($cepValue)->toString();
            ...
        }

        public function bar($cpfValue)
        {
            ...
            echo new Cpf()->mask($cpfValue);
            ...
        }



