
insert into archivo (nombre, type, rutaArch, fchReg) values 
('Comunicado', 'img', '/frontend/avisos/c4ca4238a0b923820dcc509a6f75849b.jpg', '2016-01-26 12:00:00'),
('Acta 001-2016-VRINV', 'doc', '/frontend/avisos/c81e728d9d4c2f636f067f89cc14862c.pdf', '2016-01-28 12:00:00'),
('http://unprg.edu.pe/resexm/index.html', 'link', '/frontend/avisos/eccbc87e4b5ce2fe28308fd9f2a7baf3.jpg', '2016-02-07 12:00:00'),
('16/documentos/', 'link', '/frontend/avisos/a87ff679a2f3e71d9181a67b7542122c.jpg', '2016-02-08 12:00:00');

insert into aviso (fchReg, texto, emergente, visible, estado, bloqueado, idArchivo, idUsuario) values
('2016-01-26 12:00:00', 'La Oficina General de Recursos Humanos se dirige al personal de trabajadores de la UNPRG para expresar disculpas', false, true, true, false, 1, 1),
('2016-01-28 12:00:00', 'Acta N° 001-2016-VRINV Reunión de Trabajo del Vicerrectorado de Investigación', false, true, true, false, 2, 1),
('2016-02-07 12:00:00', 'Resultados del Primer Parcial del Centro Pre UNPRG Ciclo 2016-I', false, true, true, false, 3, 1),
('2016-02-08 12:00:00', 'El Vicerrectorado de Investigación, en su proceso de implementación, pone a su disposición los siguientes documentos', true, true, true, false, 4, 1);
