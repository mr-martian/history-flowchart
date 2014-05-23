(defun get-events (args) (with-open-file (...)))
(defun get-effects (args) (with-open-file (...)))
(defun get-coords (date, graph-start, scale, geo-coords)
    (let ((co (list (/ (- date graph-start) scale) 0)))
	   	;convert geo-coords -> single number with multidimensional scaling
        co))
(defun get-name (event)
    (car event))
(defun get-link (event)
	(format nil “historyflowchart.com/essays/event.php?u=~a, e=~a” (get-name event))) ;change if necessary
(defun points-svg (events)
    (loop for ev in events collecting
        (format nil "<circle r=\"5\" stroke=\"black\" stroke-width=\"1\" cx=\"~d\" cy=\"~d\" fill=\"~a\" onclick=\"window.open('~a')\"><title>~a</title></circle>"
    		(car (get-coords ... ev)) (cadr (get-coords ... ev))
            (get-color ev) ;based on type of event?
            (get-link event) (get-name ev))))
(defun make-graph (events effects)
    (let ((gr (points-svg events)))
    	nil))
