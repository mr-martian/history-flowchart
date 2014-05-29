(defvar *universe* 'human)
(load "dirs")

(defun get-settings ()
	(load (format nil "~a/~a/settings.lisp" *data* *universe*)))
(defun get-events (args) (with-open-file (...)))
(defun get-effects (args) (with-open-file (...)))
(defun get-coords (event l h)
	(list (get-time-coord event l) (get-space-coord event h)))
(defun get-name (event)
    (car event))
(defun get-link (event)
	(format nil "~a?u=~a, e=~a" *essays* *universe* (get-name event))) ;change if necessary
(defun get-color (event)
	'red)
(defun points-svg (events)
    (loop for ev in events collecting
        (format nil "<circle r=\"5\" stroke=\"black\" stroke-width=\"1\" cx=\"~d\" cy=\"~d\" fill=\"~a\" onclick=\"window.open('~a')\"><title>~a</title></circle>"
    		(car (get-coords ev)) (cadr (get-coords ev))
            (get-color ev) ;based on type of event?
            (get-link event) (get-name ev))))
(defun lines-svg (effects)
	(loop for ef in effects collecting (list (car ef) (cadr ef))))
(defun make-graph (events effects)
    (let ((gr (points-svg events)))
    	nil))
(defun begin (&rest args)
	(format t "This program really has no idea what it's doing.")
	(setf *universe* 'human)
	(get-settings))
	;get comand line args passed by get_graph.php
	;load settings, pass stuff to make-graph, output to file in args
