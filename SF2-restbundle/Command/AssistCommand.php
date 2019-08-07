<?php
namespace XETID\RestBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class AssistCommand extends ContainerAwareCommand
{
	private $path;
    protected function configure()
    {
		$this->path = dirname(__FILE__)."/../Resources/doc/";
		$actions = implode ( '|', $this->searchDocs());
        $this->setName('service:rest:assist')
             ->setDescription('Group of utilities for REST services based in helpers docs')
			 ->addArgument('action', InputArgument::OPTIONAL, 'Can be take values as [ '.$actions.' ]')
             ->setHelp(<<<EOF
The <info>%command.name%</info> command provides a set of utilities for manipulating REST services

You can also optionally specify the action to execute, for example 
if you want to optain all request's pattern, the action argument 
need to take value <comment>pattern</comment> and can be set: 

      <info>php %command.full_name% pattern</info>

in this case used by example resource name "element" to represent that.

EOF
            );
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
		$action = $input->getArgument('action');
		
		if(method_exists($this, $action)) $this->{$action}($output);
		else{
			$file = $this->path.$action;
			if(file_exists($file)){
				$data = file_get_contents($file);
				$output->writeln($data);
			} else {
				$output->writeln("<error> Helper command requested that's not exist, please check your option </error>");
			}
		}
    }

	protected function search(OutputInterface $output)
	{
		$inf = $this->searchDocs();
		$output->writeln(' The helper docs avalibles are:');
		foreach($inf as $i) $output->writeln(" <info> $i </info>");
	}

	protected function searchDocs()
	{
		$out = array();
		$d = dir($this->path);
		while (false !== ($entry = $d->read())) if($entry!='.' && $entry!='..' && $entry!=="$entry~") $out[] = $entry;
		$d->close();
		return $out;
	}
}
