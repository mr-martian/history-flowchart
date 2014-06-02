(defvar *universe* 'human)
(load "dirs")

(defun get-settings ()
	(load (format nil "~a/~a/settings.lisp" *data* *universe*)))
(defun find-event (name)
	'(1 2 3))
(defun get-events (args) (with-open-file (...)))
(defun get-effects (args) (with-open-file (...)))
(defun get-coords (event l h)
	(list (get-time-coord event l) (get-space-coord event h)))
(defun get-name (event)
    (car event))
(defun get-event-link (event)
	(format nil "~a?u=~a&e=~a" *essays-v* *universe* (get-name event))) ;change if necessary
(defun get-effect-link (effect)
	(format nil "~a?u=~a&to=~a&from=~a" *essays-f* *universe* (car effect) (cadr effect))) ;change if necessary
(defun points-svg (events)
    (loop for ev in events collecting
        (format nil "<circle r=\"5\" stroke=\"black\" stroke-width=\"1\" cx=\"~d\" cy=\"~d\" fill=\"~a\" onclick=\"window.open('~a')\"><title>~a</title></circle>"
    		(car (get-coords ev)) (cadr (get-coords ev))
            (get-event-color ev) ;based on type of event?
            (get-link event) (get-name ev))))
(defun lines-svg (effects l h)
	(loop for ef in effects collecting
		(let ((a (find-event (car ef))) (b (find-event (cadr ef))))
			(format nil "<line x1=\"~a\" y1=\"~a\" x2=\"~a\" y2=\"~a\" color=\"~a\" onclick=\"window.open('~a')\"><title>~a to ~a</title></line>"
				(get-time-coord a) (get-space-coord a)
				(get-time-coord b) (get-space-coord b)
				(get-effect-color ef)
				(get-effect-link ef)
				(get-name a) (get-name b)))))
(defun make-graph (file events effects l h)
    (let ((pts (points-svg events l h)) (lns (lines-svg effects l h)))
    	(with-open-file (save file :direction :output :if-exists :supersede :if-does-not-exist :create)
    		(format save "~{~a~%~}~{~a~%~}" pts lns))))
(defun begin (&rest args)
	(let ((args ext:*args*))
		(format t "This program really has no idea what it's doing.")
		(setf *universe* 'human)
		(get-settings)))
		;get comand line args passed by get_graph.php
		;load settings, pass stuff to make-graph, output to file in args
		;NEEDED SETTINGS (in order): file, universe, level, event, startdate, enddate, length, height
		;date, length, height input not imlpemented. add defaults?
